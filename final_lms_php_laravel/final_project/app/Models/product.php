<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table="products";
    protected $fillable=['titel','description','price','image'];
}
