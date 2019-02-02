<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserMonster;

class UserMonsterController extends Controller
{
    //
     // create User Monster
     public function createAUserMonster(Request $request)
     {
       if(!Auth::check()){
           return "plese login";
       }
         $request->validate( [
             'name' => ['required', 'string', 'max:255'],
             'imgName' => ['required', 'string', 'max:255'],
             'AP' => ['required', 'integer'],
             'DP' => ['required', 'integer'],
             'HP' => ['required', 'integer'],
             'Speed' => ['required', 'integer'],
             ]);

             $data = $request->input();

         $moster =  UserMonster::create([
             'name' => $data['name'],
             'imgName' => $data['imgName'],
             'idUser' => Auth::id(),
             'AP' => $data['AP'],
             'DP' => $data['DP'],
             'HP' => $data['HP'],
             'Speed' => $data['Speed'],
             ]);
         return  $moster;
        }

        // to do
    public function iMLogin()
    {
        //  return "asd";
        if(Auth::check())
        {
            return 1;
        }else{
            return 0;
        }
    }

     // Get User Monster
     public function getUserMonster(Request $request)
     {
        $request->validate( [
            'idUser' => ['required', 'integer'],
        ]);
        if($request->input()["idUser"] != Auth::id())
        {
            return "is not your monster";
        }
        $monster = UserMonster::find($request->input()["idUser"]);// "Class 'App\\Http\\Controllers\\Monster' not found",

        return  $monster->getAllData();
     }
}
