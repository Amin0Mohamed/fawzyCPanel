<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Workshop;
use Validator;

class WorkshopController extends Controller
{
	 /**
  	 * @OA\Get(
  	 *     path="/workshop",
  	 *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="display git name on workshop",
     *         required=true,
     *     ),
      @OA\Parameter(
     *         name="icon",
     *         in="query",
     *         description="display git url include image",
     *         required=true,
     *     ),
	 *     @OA\Response(response="200", description="get specific exhibition with id")
	 * )
    */
   public function getAllWorkShow()
   {
       $workshop = Workshop::all();
       if ($workshop->count() > 0){
           return response()->json(['data'=>$workshop,'message'=>null,'status' => 1]);
       }else{
           return response()->json(['data'=>null,'message'=>'there is no data','status' => 0]);
       }
   }
	public function workshop(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'icon' => 'required',
			'name' => 'required'
		]);
		if ($validator->fails()) {
			 return response()->json(['data'=>null,'message' => $validator->messages(), 'status' => 0]);
		}else{
            $file = $request->file('icon');
            $destinationPath = 'storage/users';
            $originalFile = $file->getClientOriginalName();
            $filename = strtotime(date('Y-m-d-H:isa')).$originalFile;
            $file->move($destinationPath, $filename);
            $input['icon'] = url('/storage/users/'. $filename);
            $input['name'] = $request->name;
            $workshop = Workshop::create($input);
            return response()->json(['data'=>$workshop,'message'=> null,'status'=>1]);
        }


    }


}
