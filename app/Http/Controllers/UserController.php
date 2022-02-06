<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function signUpShow(Request $request) {
        if(Auth::guard('user')->check()){
            return redirect()->route("user.profile");
        }

        return view('user.sign-up');
    }

    public function signUp(Request $request) {
        if(Auth::guard('user')->check()){
            return redirect()->route("user.profile");
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return redirect()->route("user.signin.show");
    }

    public function signInShow(Request $request) {
        if(Auth::guard('user')->check()){
            return redirect()->route("user.profile");
        }

        return view('user.sign-in');
    }

    public function signIn(Request $request) {
        if(Auth::guard('user')->check()){
            return redirect()->route("user.profile");
        }
        Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password]);
        return redirect()->route("user.profile");
    }

    public function logout(Request $request) {
        Auth::guard('user')->logout();
        return redirect()->route("user.signin.show");
    }

    public function profile(Request $request) {
        $user = Auth::guard('user')->user();
        return view('user.profile', ["user" => $user]);
    }

    public function forgetPasswordShow(Request $request) {
        if(Auth::guard('user')->check()){
            return redirect()->route("user.profile");
        }

        return view('user.forget-password');
    }

    public function forgetPasswordSendEmail(Request $request) {
        if(Auth::guard('user')->check()){
            return redirect()->route("user.profile");
        }

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);

        // return view('user.password.reset');
    }

    public function passwordReset(Request $request) {
        if(Auth::guard('user')->check()){
            return redirect()->route("user.profile");
        }

        return view('user.password.reset');
    }
}
