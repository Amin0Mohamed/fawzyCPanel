<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MainProgram;
use App\Chair;
use App\Presentation;

class MainProgramController extends Controller
{
	/**
  	 * @OA\Get(
  	 *     path="/display_program",
  	 *     @OA\Parameter(
     *         name="program_id",
     *         in="query",
     *         description="program id",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="session_number",
     *         in="query",
     *         description="session number",
     *         required=true,
     *     ),
	   *     @OA\Response(response="200", description="display a main program session with its all details")
	   * )
     */
        public function display_program(Request $request){
            if ($request->has('main_program_id') && $request->has('session_number')){
                $session = MainProgram::where('program_id',$request->main_program_id)->where('session_number', $request->session_number)->first();

                    $session['chairs'] = Chair::where('main_program_id',$session->id)->get();
                    $session['presentations'] = Presentation::where('main_program_id',$session->id)->get();
                
                if ($session !== null) {
                    $chairs = Chair::where('main_program_id', $session->id)->get();
                    $presentations = Presentation::where('main_program_id', $session->id)->get();
                }else{
                    return response()->json(['data'=>null,'message'=>'there is no data','status'=>0]);
                }
                return response()->json(['data'=>['session'=>$session ,'chairs'=> $chairs ,'presentations'=>$presentations],'message'=>null,'status'=>1]);
            }else{
                return response()->json(['data'=>null,'message'=>'make sure send main_program_id and session_number','status'=>0]);
            }

        }
}
