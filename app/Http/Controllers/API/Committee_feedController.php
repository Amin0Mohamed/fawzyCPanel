<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Committee_feed;
use Validator;

class Committee_feedController extends Controller
{   /**
     * @OA\Get(
     *     path="/display_committee",
     *     @OA\Response(response="200", description="displays committees and new feeds")
     * )
     */
    public function display_committee(){

        $commit = Committee_feed::all();
        if ($commit->count() > 0){
            return response()->json(['data'=> $commit,'message'=> null,'status'=>1]);
        }else{
            return response()->json(['data'=> null,'message'=> 'there is no data','status'=>0]);
        }
    }

    /**
     * @OA\Post(
     *     path="/insert_committee",
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="title which is committee or new feeds ",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="body",
     *         in="query",
     *         description="body of committee or new feed",
     *         required=true,
     *     ),
     *     @OA\Response(response="200", description="insert title and body into committee or new feeds")
     * )
     */

    public function insert_committee(Request $request){

        $validator = Validator::make($request->all(),[
            'title'=>'required|max:255',
            'body'=>'required',
        ]);

        $input = $request->all();

        if($validator->fails()){
            return response()->json(['data'=>null,'message'=>$validator->messages() , 'status' =>0]);
        }else{
           $commite = Committee_feed::create($input);
           return response()->json(['data'=>$commite ,'message'=>null,'status' =>1]);
        }



    }
}
