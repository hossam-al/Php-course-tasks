<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
        use HasFactory;

    protected $table = "departments";
    protected $fillable = ['name', 'description'];


    function Employee(){
        return $this->hasMany(Employee::class);
    }
}
