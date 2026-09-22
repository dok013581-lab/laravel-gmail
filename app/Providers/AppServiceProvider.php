<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.default');
        View::composer(['dashboard', 'tasks.index', 'profile', 'home'], function ($view) {
            if (Auth::check()) {
                $user = Auth::user();

                $notifOverdue = $user->tasks()
                    ->whereDate('deadline', '<', today())
                    ->where('status', '!=', 'Hoàn thành')
                    ->orderBy('deadline', 'asc')
                    ->take(5)
                    ->get();

                $notifUpcoming = $user->tasks()
                    ->whereBetween('deadline', [today(), today()->addDays(7)])
                    ->where('status', '!=', 'Hoàn thành')
                    ->orderBy('deadline', 'asc')
                    ->take(5)
                    ->get();

                $notifCount = $user->tasks()
                    ->where('status', '!=', 'Hoàn thành')
                    ->where(function ($q) {
                        $q->whereDate('deadline', '<', today())
                          ->orWhereBetween('deadline', [today(), today()->addDays(7)]);
                    })
                    ->count();

                $view->with([
                    'notifOverdue' => $notifOverdue,
                    'notifUpcoming' => $notifUpcoming,
                    'notifCount' => $notifCount,
                ]);
            }
        });
    }
}
