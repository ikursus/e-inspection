<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('pengguna.template-dashboard');
    }

    public function profile()
    {
        return view('pengguna.template-profile');
    }
}