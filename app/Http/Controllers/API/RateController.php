<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rate_session;
use Validator;


class RateController extends Controller

{

    public function insert_rate(Request $request)
    {

         $validator = Validator::make($request->all(),[
             'number' => 'required|max:5'
         ]);
         if ($validator->fails()){
             return response()->json(['data' => null,'message' => $validator->messages(),'status'=>0]);
         }

        $data = $request->all();
        $rate = Rate_session::create($data);
        return response()->json(['data' => $rate,'message' => null,'status'=>1]);

    }



}
