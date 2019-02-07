<?php



namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Monster;
use App\User;
use App\UserMonster;

class searchController extends Controller
{



    public function search(Request $request)
    {
        $request->validate( [
            'search' => ['required', 'string'],
        ]);


        /**?
         * $request->input()['search'] is id:44
         * afer explode
         * array:2 [
            0 => "id"
            1 => "44"
            ]
            /////////////////////////////////
            $request->input()['search'] is Heiko
             afer explode
         *  array:1 [
             0 => "Heiko"
            ]

         */
        $SearchTyeArray =  explode(':',$request->input()['search'] );

        if(count($SearchTyeArray) == 2){
            $searchNameConfig = [
                "id" => 'id',
                "name" => 'Name',
                "AP" => 'AP',
                "DP" => 'DP',
                "imgName" => 'Img Name',
                "Speed" => 'Speed',
                "SpwanWert" => 'SpwanWert',
                "HP" => 'HP',
            ];

            if(  $SearchTyeArray[0] == $searchNameConfig['id']){
                return [
                    "Monster" => $this->getMonsters('id', $SearchTyeArray[1]),
                    "User" => $this->getUser('id', $SearchTyeArray[1]),
                    "UserMonster" =>  $this->getUserMonster('id', $SearchTyeArray[1])
                ];
            }
            if(  $SearchTyeArray[0] == $searchNameConfig['name']){
                return [
                    "Monster" => $this->getMonsters('name', $SearchTyeArray[1]),
                    "User" => $this->getUser('name', $SearchTyeArray[1]),
                    "UserMonster" =>  $this->getUserMonster('name', $SearchTyeArray[1])
                ];
            }
            if(  $SearchTyeArray[0] == $searchNameConfig['AP']){
                return [
                    "Monster" => $this->getMonsters('AP', $SearchTyeArray[1]),
                    "UserMonster" =>  $this->getUserMonster('AP', $SearchTyeArray[1])
                ];
            }
            if(  $SearchTyeArray[0] == $searchNameConfig['DP']){
                return [
                    "Monster" => $this->getMonsters('DP', $SearchTyeArray[1]),
                    "UserMonster" =>  $this->getUserMonster('DP', $SearchTyeArray[1])
                ];
            }
            if(  $SearchTyeArray[0] == $searchNameConfig['imgName']){
                return [
                    "Monster" => $this->getMonsters('imgName', $SearchTyeArray[1]),
                    "UserMonster" =>  $this->getUserMonster('imgName', $SearchTyeArray[1])
                ];
            }
            if(  $SearchTyeArray[0] == $searchNameConfig['Speed']){
                return [
                    "Monster" => $this->getMonsters('Speed', $SearchTyeArray[1]),
                    "UserMonster" =>  $this->getUserMonster('Speed', $SearchTyeArray[1])
                ];
            }
            if(  $SearchTyeArray[0] == $searchNameConfig['SpwanWert']){
                return [
                    "Monster" => $this->getMonsters('SpwanWert', $SearchTyeArray[1]),
                    "UserMonster" =>  $this->getUserMonster('SpwanWert', $SearchTyeArray[1])
                ];
            }
            if(  $SearchTyeArray[0] == $searchNameConfig['HP']){
                return [
                    "Monster" => $this->getMonsters('HP', $SearchTyeArray[1]),
                    "UserMonster" =>  $this->getUserMonster('HP', $SearchTyeArray[1])
                ];
            }

        }
        return [
            "Monster" => $this->getMonsters('name', $SearchTyeArray[0]),
            "User" => $this->getUser('name', $SearchTyeArray[0]),
            "UserMonster" =>  $this->getUserMonster('name', $SearchTyeArray[0])
        ];
    }

    public function getMonsters(string $type, string $Search)
    {
        return Monster::where($type, $Search)->get();

    }

    public function getUser(string $type, string $Search)
    {
        $temp = User::where($type, $Search)->get();
        if(count($temp) == 0)
        {
            return [];
        }
        $output = [['id'=> $temp[0]['id'],'name'=> $temp[0]['name']]];
        return  $output;
    }

    public function getUserMonster(string $type, string $Search)
    {
        return UserMonster::where($type, $Search)->get();
    }

}

