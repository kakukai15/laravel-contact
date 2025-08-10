<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function showRegisterForm()
{
    return view('auth.register');
}

public function register(AuthorRequest $request)
    {
    $data = $request->validated();

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);

    return redirect('/admin');
    }

    public function login(LoginRequest $request)
    {
         $credentials = $request->validated();

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/admin');
    }

    return back()->withErrors([
        'email' => '認証に失敗しました。',
    ]);
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}

}
