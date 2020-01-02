<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Abstract_web;

class Abstract_webController extends Controller
{


	/**
  	 * @OA\Get(
  	 *     path="/getAbsract",
  	
	   *     @OA\Response(response="200", description="display get link abstract")
	   * )
     */
       public function getAbstract()
   {
   		$abstract = Abstract_web::all();
   		if ($abstract->count() > 0){
            return response()->json(['data' => $abstract,'message'=>null,'status'=>1]);
        }else{
            return response()->json(['data' => null,'message'=>'there is no data','status'=>0]);
        }

   }

}
