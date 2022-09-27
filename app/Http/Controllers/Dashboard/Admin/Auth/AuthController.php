<?php

namespace App\Http\Controllers\Dashboard\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');

    }//end of fun

    public function store(Request $request)
    {
        $admin = Admin::first();
        auth('admin')->login($admin);
        session()->flash('success', __('site.login_successfully'));

        return redirect()->route('dashboard.admin.welcome');

    }//end of fun

    public function logout()
    {
        auth('admin')->logout();

        return redirect()->route('dashboard.login.index');

    }//end of fun

}//end of controller