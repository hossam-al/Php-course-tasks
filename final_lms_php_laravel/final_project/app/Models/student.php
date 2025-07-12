<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $table="students";
    protected $fillable=['user_id','college','degree','group_id'];
    public function user()
    {
        return  $this->belongsTo(User::class);
    }
    public function group(){
    return $this->belongsTo(Group::class)->with('round');
    }
}

