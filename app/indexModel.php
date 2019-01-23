<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    /**
     * The attributes that are guarded from mass assignment.
     *
     * @var array
     */
    protected $guarded = [];
    protected $dates = ['deadline_at'];
    
    public function tags() {
        dd("asdd");
        return $this->belongsToMany(Tag::class, 'tasks_tags');
    }
    

}