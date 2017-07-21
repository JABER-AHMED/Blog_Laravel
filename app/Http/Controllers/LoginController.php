<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function getLogin()
    {
    	return view('auth.login');
    }

    public function postLogin(Request $request)
    {
    	if (Auth::attempt([

    		'email' => $request->get('email'),
    		'password' => $request->get('password')

    		])) {

    			return redirect()->route('home');
    	}
    	else{

    		return redirect()->back();
    	}
    }
    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }
}