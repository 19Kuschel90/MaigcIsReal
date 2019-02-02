<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMonster extends Model
{

    protected $guarded = [];
    protected $table = 'userMonster';
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
    public function getHP()
    {
        return $this->HP;
    }
    public function updateMonster(arrary $array):arrary
    {
        # code...
    }

}
