<?php



namespace App;
use Illuminate\Database\Eloquent\Model;



class Monster extends Model
{

    /**
     * The attributes that are guarded from mass assignment.
     *
     * @var array
     */
    protected $guarded = [];
    protected $table = 'monster';

    public function getAllData()
    {
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getAP()
    {
        return $this->AP;
    }
    public function getDP()
    {
        return $this->DP;
    }
    public function getimgName()
    {
        return $this->imgName;
    }
    public function getSpeed()
    {
        return $this->Speed;
    }
    public function getSpwanWert()
    {
        return $this->SpwanWert;
    }
    public function updateMonster(arrary $array):arrary
    {
        # code...
    }

}

