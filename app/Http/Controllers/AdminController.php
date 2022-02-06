<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function signUpShow(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route("admin.profile");
        }

        return view('admin.sign-up');
    }

    public function signUp(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route("admin.profile");
        }
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return redirect()->route("admin.signin.show");
    }

    public function signInShow(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route("admin.profile");
        }

        return view('admin.sign-in');
    }

    public function signIn(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route("admin.profile");
        }
        Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        return redirect()->route("admin.profile");
    }

    public function logout(Request $request)
    {
        
        Auth::guard('admin')->logout();
        return redirect()->route("admin.signin.show");
    }

    public function profile(Request $request)
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile', ["user" => $user]);
    }
}
