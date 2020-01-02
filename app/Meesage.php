<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meesage extends Model
{
    protected $fillable = ['name','email','subject','text'];
}
