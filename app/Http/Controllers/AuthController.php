<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRoleModel;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // kalau tak jumpa user
            return redirect('/auth/login')->with('error', 'Email not found');
        }

        if (!Hash::check($request->password, $user->password)) {
            // kalau password salah
            return redirect('/auth/login')->with('error', 'Invalid password');
        }

        // kalau email dan password betul
        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/dashboard');
    }


    public function showRegister()
    {
        $getUserRole = UserRoleModel::all(); 
        return view('auth.register', compact('getUserRole'));
    
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'staff_num' => 'required|unique:users,staff_num',
            'department' => 'required',
            'phone_num' => 'required|unique:users,phone_num',
            'branch' => 'required',
            'user_role_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'staff_num.unique' => 'Staff number already exists.',
            'phone_num.unique' => 'Phone number already exists.',
            'email.unique' => 'Email already exists.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'staff_num' => $request->staff_num,
            'department' => $request->department,
            'phone_num' => $request->phone_num,
            'branch' => $request->branch,
            'user_role_id' => $request -> user_role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(), // Auto-verify untuk sistem internal
        ]);

        return redirect('/auth/login')->with('success', 'Registration successful. Please login.');

        if (User::where('email', $request->email)->exists()) 
        {
            return back()->with('error', 'Email already exists.');
        }

        if (User::where('staff_num', $request->staff_num)->exists()) 
        {
            return back()->with('error', 'Staff number already exists.');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::info('LOG OUT');
        return redirect('/auth/login');
    }
}
