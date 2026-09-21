<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'password' => bcrypt(\Illuminate\Support\Str::random(32)),
                ]
            );

            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Đăng nhập thành công!');
        } catch (\Throwable $e) {
            return redirect('/login')->with('error', 'Đăng nhập bằng Google không thành công hoặc đã bị hủy. Vui lòng thử lại!');
        }
    }
}