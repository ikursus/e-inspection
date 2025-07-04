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

        // return $data;

        return redirect()->route('user.dashboard');
    }
}
