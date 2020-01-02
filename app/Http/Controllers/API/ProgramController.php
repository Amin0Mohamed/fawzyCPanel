<?php

namespace App\Http\Controllers\API;

use App\Chair;
use App\Http\Controllers\Controller;
use App\Presentation;
use Illuminate\Http\Request;
use App\Program;
use App\MainProgram;

class ProgramController extends Controller
{

     /**
  	 * @OA\Get(
  	 *     path="/display_programs",
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="program date",
     *         required=true,
     *     ),
	   *     @OA\Response(response="200", description="display all program sessions with brief details")
	   * )
     */
    public function display_programs(Request $request){
        $programs = Program::where(['date' => $request->date])->first();
        if($programs !== null){
            $main_programs = MainProgram::query()->select('id','program_id','session_number','session_name' , 'location','presenters','start_time')->where('program_id',$programs->id)->get();

            return response()->json(['data'=>$main_programs,'message'=>null,'status'=>1]);
        }else{
            return response()->json(['data'=>null,'message'=>'there is no data','status'=>0]);
        }
    }
}
