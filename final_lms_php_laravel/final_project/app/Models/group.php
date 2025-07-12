<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    protected $table = "groups";
    protected $fillable = ['name', 'round_id', 'insructors_id'];
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function instructors()
    {
        return $this->belongsTo(insructors::class, 'insructors_id');
    }
}
