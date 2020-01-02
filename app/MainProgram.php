<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainProgram extends Model
    {
   protected $fillable = ['program_id','session_number','session_name','location','presenters','start_time','end_time','session_number'];
    //protected $guarded = ['id'];

    public function main_programs(){
    	return $this->hasMany(Chair::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function presentations(){
    	return $this->hasMany(Presentation::class);
    }

}
