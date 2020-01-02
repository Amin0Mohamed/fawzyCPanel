<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    protected $fillable = ['name','location','time','main_program_id'];

        protected $guarded = ['id'];
}
