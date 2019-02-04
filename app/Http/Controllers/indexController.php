<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function GetYourUser(Request $request)
    {
        return Auth::user();
    }

    public function getUserName()
    {
        if(Auth::check()){
                return Auth::user()->name;
        }else{
            return 0;// not log in
        }

    }

    public function updateUserData(Request $request)
    {
        if(Auth::id() != $request->input()['id'])
        {
            return "ID != ID";
        }
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            ]);


            $user =  User::find(Auth::id());

            $user->update($request->input());

        return $request->input();

    }



}

