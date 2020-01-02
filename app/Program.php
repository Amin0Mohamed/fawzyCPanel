<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	
        protected $guarded = ['id'];

        public function main_programs(){
        	return $this->hasMany(MainProgram::class);
        }

}
