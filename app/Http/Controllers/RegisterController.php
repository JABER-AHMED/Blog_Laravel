<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getRegister()
    {
    	return view('auth.register');
    }
    public function register(Request $request)
    {
         $this->validate($request, array(

            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ));

        $useremail = User::where('email', $request->email)->first();

        if ($useremail) {
            Session::flash('danger', 'Email has already taken');
            return redirect()->back();
        }
        else{
    	$user = new User;
    	$user->id = $request->id;
    	$user->firstname = $request->firstname;
    	$user->lastname = $request->lastname;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
        $user->password_confirmation = bcrypt($request->password_confirmation);

    	$user->save();

        Session::flash('success', 'Successfully Registered User');

    	return redirect()->route('login');
       }
    }
}
