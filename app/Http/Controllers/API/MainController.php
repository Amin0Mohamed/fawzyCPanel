<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Main_topic;
use Validator;


class MainController extends Controller
{

    public function main_topic(Request  $request)
    {
        if (!$request->has('title')) {
            return response()->json(['data' => null, 'message' => 'title is required','status' => 0 ]);
        } elseif (!$request->has('body')) {
            return response()->json(['data' => null, 'message' => 'body is required','status' => 0]);
        }
        else{
                $data = $request->all();
                $main = Main_topic::create($data);
                return response()->json(['data' => $main,'message' => null,'status'=>1]);
        }
         }

    public function show(){
        $show = Main_topic::all();
        if ($show->count() > 0){
            return response()->json(['data' =>  $show,'message'=>null,'status' => 1 ]);
        }else{
            return response()->json(['data' =>  null,'message'=>'there is no data','status' => 0 ]);
        }
    }


}




