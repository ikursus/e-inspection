<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function borang() {
        return view('authentication.template-login');
    }

    public function processLogin(Request $request) {

        // $email = $_POST['email'];
        // $email = $request->input('email');
        // $data = $request->all();
        // $data = $request->except('_token');
        // $data = $request->only('email', 'password');
        $data = $request->validate([
            'email' => 'required|email:filter', // Cara tulis rules menerusi string
            'password' => ['required', 'min:3'], // Cara tulis rules menerusi array
            'remember' => 'boolean'
        ]);

        if (auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ], $data['remember'] ?? false)) {
            // Regenerate session for security
            $request->session()->regenerate();
            
            return auth()->user()->role === 'admin' 
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        auth()->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
