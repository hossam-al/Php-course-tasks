<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $fillable = ['name','salary','image','department_id'];



    function department(){
        return $this->belongsTo(Department::class);
    }
}
