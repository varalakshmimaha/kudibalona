<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function showLogin() {
        if (Auth::check() || Session::get('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            Session::put('admin_logged_in', true);
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors(['credentials' => 'Invalid username or password.'])->withInput();
    }

    public function logout() {
        Auth::logout();
        Session::forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
