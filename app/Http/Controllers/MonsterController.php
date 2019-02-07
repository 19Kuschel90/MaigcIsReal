<?php



namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Monster;

class MonsterController extends Controller
{
    // Create A new Moster
    public function createAMonster(Request $request)
    {
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'imgName' => ['required', 'string', 'max:255'],
            'AP' => ['required', 'integer'],
            'DP' => ['required', 'integer'],
            'HP' => ['required', 'integer'],
            'Speed' => ['required', 'integer'],
            'SpwanWert' => ['required', 'integer'],
            ]);
        $data = $request->input();
       $moster =  Monster::create([
            'name' => $data['name'],
            'imgName' => $data['imgName'],
            'AP' => $data['AP'],
            'DP' => $data['DP'],
            'HP' => $data['HP'],
            'Speed' => $data['Speed'],
            'SpwanWert' => $data['SpwanWert'],
        ]);
        return  $moster;
    }



    // Return a Ramdom Moster
    public function ramdomSpawn()
    {
        return Monster::find(random_int(1,5));
    }

    public function getAMonster(Request $request)
    {
        $request->validate( [
            'id' => ['required', 'integer'],
        ]);
        $monster = Monster::find($request->input()["id"]);// "Class 'App\\Http\\Controllers\\Monster' not found",

        return  $monster->getAllData();
    }

    public function getLastMonster(Request $request)
    {
            // $monsters =   Monster::;
            $monsters = Monster::orderBy('id', 'DESC')->take(4)->get();
            return $monsters;
    }

}

