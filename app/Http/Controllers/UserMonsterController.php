<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserMonster;
use App\Http\Controllers\MonsterController;
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

            // is for all users can see and war
            $monsterController = new MonsterController();
            $monsterController->createAMonster($request);

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

    public function destroy(Request $request)
    {
        $request->validate( [
            'id' => ['required', 'integer'],
            ]);
            UserMonster::where('id', $request->input()['id'])->delete();
        // UserMonster::destroy($request->input()['id']);
        return "IO";
    }

    public function getAllUserMonster(Request $request)
    {
        if(Auth::check())
        {
           return UserMonster::where('idUser', Auth::id())->get();// "Class 'App\\Http\\Controllers\\Monster' not found",
        }else{
            return 'please login';
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
