<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function register(){
        return view('account.register');
    }
    public function processregister(Request $request){
     $validator = Validator::make($request->all(),[
        'name'=> 'required|min:3',
        'email'=> 'required|email',
        'password'=> 'required|confirmed|min:5',
        'password_confirmation'=> 'required',
     ]);
     if($validator->fails()){
        return redirect()->route('account.register')->withInput()->withErrors($validator);
     }

     $user = new User();
     $user -> name = $request->name;
     $user -> email = $request->email;
     $user -> password = Hash::make($request->password);
     $user -> save();

     return redirect()->route('account.login')->with('success','You Have Successfully Registerd');

    }


    public function login(){
        return view('account.login');
    }
}
