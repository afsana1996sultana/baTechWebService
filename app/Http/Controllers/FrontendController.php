<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FrontendController extends Controller
{
    public function index(Request $request)
    {

    }

    public function login(){
        return view('frontend.auth.login');
    }

    public function loginCheck(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email', // Check if email exists in the users table
            'password' => 'required|min:6|max:30',
        ], [
            'email.exists' => 'This email does not exist in the user table',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::guard('web')->attempt($credentials)){
            return redirect()->route('all-information.index')->with('success', 'Successfully logged in');
        } else {
            return redirect()->route('index')->with('error', 'Incorrect credentials');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/')->with('success','Successfully logout');
    }
}
