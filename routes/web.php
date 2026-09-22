<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/auth/google', [GoogleController::class, 'redirect']);

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/dashboard', function () {
    $user = Auth::user();

    $totalTasks = $user->tasks()->count();
    $pendingTasks = $user->tasks()->where('status', 'Chưa làm')->count();
    $doingTasks = $user->tasks()->where('status', 'Đang làm')->count();
    $completedTasks = $user->tasks()->where('status', 'Hoàn thành')->count();

    $overdueTasks = $user->tasks()
        ->whereDate('deadline', '<', today())
        ->where('status', '!=', 'Hoàn thành')
        ->count();

    $upcomingTasks = $user->tasks()
        ->whereBetween('deadline', [today(), today()->addDays(7)])
        ->where('status', '!=', 'Hoàn thành')
        ->count();

    $recentTasks = $user->tasks()->latest()->take(5)->get();

    $overdueTasksList = $user->tasks()
        ->whereDate('deadline', '<', today())
        ->where('status', '!=', 'Hoàn thành')
        ->orderBy('deadline', 'asc')
        ->take(5)
        ->get();

    $upcomingTasksList = $user->tasks()
        ->whereBetween('deadline', [today(), today()->addDays(7)])
        ->where('status', '!=', 'Hoàn thành')
        ->orderBy('deadline', 'asc')
        ->take(5)
        ->get();

    $lowPriorityTasks = $user->tasks()->where('priority', 'Thấp')->count();
    $mediumPriorityTasks = $user->tasks()->where('priority', 'Trung bình')->count();
    $highPriorityTasks = $user->tasks()->where('priority', 'Cao')->count();

    return view('dashboard', compact(
        'totalTasks',
        'pendingTasks',
        'doingTasks',
        'completedTasks',
        'overdueTasks',
        'upcomingTasks',
        'lowPriorityTasks',
        'mediumPriorityTasks',
        'highPriorityTasks',
        'recentTasks',
        'overdueTasksList',
        'upcomingTasksList'
    ));
})->middleware('auth');

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Đã đăng xuất khỏi hệ thống!');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        $user = Auth::user();
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('status', 'Hoàn thành')->count();

        return view('profile', compact('totalTasks', 'completedTasks'));
    });

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/create', [TaskController::class, 'create']);
    Route::post('/tasks', [TaskController::class, 'store']);

    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

    Route::get('/tasks/{task}/attachments/{attachment}/download', [TaskController::class, 'downloadAttachment']);
    Route::delete('/tasks/{task}/attachments/{attachment}', [TaskController::class, 'destroyAttachment']);

    // Task Checklist Routes
    Route::post('/tasks/{task}/checklists', [TaskController::class, 'storeChecklist']);
    Route::put('/tasks/{task}/checklists/{checklist}', [TaskController::class, 'updateChecklist']);
    Route::patch('/tasks/{task}/checklists/{checklist}/toggle', [TaskController::class, 'toggleChecklist']);
    Route::delete('/tasks/{task}/checklists/{checklist}', [TaskController::class, 'destroyChecklist']);
});