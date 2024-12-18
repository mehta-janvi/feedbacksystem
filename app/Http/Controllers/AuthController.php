<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\FeedbackSystem;

class AuthController extends Controller
{
    //
    public function index()
    {
        $feedback = FeedbackSystem::count();
        return view('Auth.admindashbaord',compact('feedback'));
    }   
    public function showLoginForm()
    {
        return view('Auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the admin
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            // Redirect to admin panel if successful
            return redirect()->route('admin.index');
        }

        // Redirect back with an error if login fails
        return redirect()->back()->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/')->with('success', 'Logged out successfully.');
    }   
}
