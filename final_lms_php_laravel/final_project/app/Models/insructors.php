<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class insructors extends Model

{
    protected $table = "insructors";
    protected $fillable = ['track', 'linkedin', 'user_id','departments_id'];
    public function user()
    {
        return  $this->belongsTo(User::class);
    }
    public function departments(){
        return  $this->belongsTo(departments::class);
    }
}
