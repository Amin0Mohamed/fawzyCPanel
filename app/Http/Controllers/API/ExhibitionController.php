<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exhibition;

class ExhibitionController extends Controller
{

    /**
  	 * @OA\Get(
  	 *     path="/all_exhibitions",
	 *     @OA\Response(response="200", description="Get all Exhibitions")
	 * )
    */
    public function all_exhibitions(){
        $exhibition = Exhibition::all();
        if ($exhibition->count() > 0){
            return response()->json(['data' => $exhibition ,'message'=>null, 'status' => 1]);
        }else{
            return response()->json(['data' => null ,'message'=>'there is no data', 'status' => 0]);
        }
     }



     /**
  	 * @OA\Get(
  	 *     path="/get_exhibition",
  	 *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="exhibition id",
     *         required=true,
     *     ),
	 *     @OA\Response(response="200", description="get specific exhibition with id")
	 * )
    */
     public function get_exhibition(Request $request){

        $exhibition = Exhibition::find($request->id);
        if($exhibition !== null){
         return response()->json(['data' => $exhibition,'message'=>null,'status'=>1]);
        }else{
         return response()->json(['data' => null,'message'=> 'there is no data','status'=>0]);
        }

     }
}
