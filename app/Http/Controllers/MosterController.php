<?php



namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Moster;
class MosterController extends Controller
{

    // Create A new Moster
    public function createAMoster(Request $request)
    {
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'imgName' => ['required', 'string', 'max:255'],
            'AP' => ['required', 'integer'],
            'DP' => ['required', 'integer'],
            'Speed' => ['required', 'integer'],
            'SpwanWert' => ['required', 'integer'],
            ]);
        $data = $request->input();    
       $moster =  Monster::create([
            'name' => $data['name'],
            'imgName' => $data['imgName'],
            'AP' => $data['AP'],
            'DP' => $data['DP'],
            'Speed' => $data['Speed'],
            'SpwanWert' => $data['SpwanWert'],
        ]);
        return  $moster;
    }

    // Return a Ramdom Moster
    public function RamdomSpawn()
    {
        return Monster::random_int(0,2);
    }

    public function getAMoster(Request $request)
    {
       $mosters = Monster::all();// "Class 'App\\Http\\Controllers\\Monster' not found",

       foreach ($mosters as $moster) {
           dd( $moster);
       }
        return  "sdsd";
    }

}

