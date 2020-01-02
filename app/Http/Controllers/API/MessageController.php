<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Meesage;
use Validator;

class MessageController extends Controller
{
    public function insert_Message(Request $request)
    {


        if (!$request->has('name')){
            return response()->json(['status'=>0,'message' => 'name is required', 'data' => null]);
        }elseif (!$request->has('email')){
            return response()->json(['status'=>0,'message' => 'email is required', 'data' => null]);
        }elseif(!$request->has('subject')){
            return response()->json(['status'=>0,'message' => 'subject is required', 'data' => null]);
        }elseif(!$request->has('text')){
            return response()->json(['status'=>0,'message' => 'text is required', 'data' => null]);
        }else{
            $data = $request->all();

            $message = Meesage::create($data);

            return response()->json(['status'=>1,'message' => null, 'data' => $message]);
        }
    }
}
