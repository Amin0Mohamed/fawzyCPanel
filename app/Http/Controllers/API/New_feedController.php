<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\New_feed;

class New_feedController extends Controller
{


	/**
  	 * @OA\Get(
  	 *     path="/new_feed",
  	
	   *     @OA\Response(response="200", description="display all new feeds")
	   * )
     */

	 public function new_feed()
	{

        $new_feed= New_feed::all();
        if ($new_feed->count() > 0){
            return response()->json(['data' => $new_feed,'message'=> null , 'status' => 1]);
        }else{
            return response()->json(['data' => null,'message' => 'there is no data' , 'status' => 0]);
        }

    }

}


