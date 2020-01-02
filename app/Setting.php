<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['display_name','var','value','type'];

    public $timestamps = false;
}
