<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserFirstAndLastName;
use Illuminate\Support\Facades\Auth;

class UserFirstAndLastNameController extends Controller
{
    //

        public function createUserFirstAndLastName(int $id,array $data)
        {

                $user =  UserFirstAndLastName::create([
                    'idUser' => $id,
                    'firstName' => $data['firstName'],
                    'lastName' => $data['lastName'],
                    ]);
                    return 'create User First And LastName';

         }

            public function updateUserFirstAndLastName(Request $request)
            {
                $request->validate( [
                    'firstName' => ['required', 'string', 'max:255'],
                    'lastName' => ['required', 'string', 'max:255'],
                    ]);
            $table =  UserFirstAndLastName::where('idUser', Auth::id());
            $toUpdate = ['firstName' =>   $request->input()['firstName'] ,'lastName' =>  $request->input()['lastName']];
            $table->update($toUpdate);

            return 'update User First And LastName';
    }

    public function getUserFirstAndLastName()
    {
        // dd(UserFirstAndLastName::find(Auth::id())>get());
        return  UserFirstAndLastName::where('idUser', Auth::id())->get();
    }
}
