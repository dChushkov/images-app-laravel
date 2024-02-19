<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        $users = User::withCount('photos')->orderByDesc('photos_count')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Аутентикирайте потребителя след успешна регистрация
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'You are successfully registered and logged in.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials, $request->filled('remember'))) {
           
            return redirect()->intended('/')->with('success', 'You are logged in!');
        }
    
        return back()->withInput($request->only('email'))->withErrors(['email' => 'The provided credentials do not match our records. Please try again.']);
    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'You have been successfully logged out!');
}
}
