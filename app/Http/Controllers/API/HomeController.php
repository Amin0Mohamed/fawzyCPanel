<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Home;
use Validator;

class HomeController extends Controller
{


   /**
  	 * @OA\Post(
  	 *     path="/insert_into_home",
  	 *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="PDF title",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="PDF",
     *         in="query",
     *         description="PDF File",
     *         required=true,
     *     ),
	   *     @OA\Response(response="200", description="insert title and pdf into home screen")
	   * )
     */

    public function insert_into_home(Request $request){

        $validator = Validator::make($request->all(), [
		            'title' => 'required',
		            'PDF' => 'required|mimes:pdf',
		        ]);

		        if ($validator->fails()) {
		            return response()->json(['data'=>null ,'message'=>$validator->messages() , 'status' => 0]);
		        }
		        $input = $request->all();
		        if($request->hasFile('PDF')){
		            $input['PDF'] = $request->file('PDF');
		            $allowedfileExtension=['pdf'];
		            $extension = $input['PDF']->getClientOriginalExtension();
		            $filename =pathinfo($input['PDF']->getClientOriginalName(), PATHINFO_FILENAME);
		            $filename = md5($filename . time()) .'.' . $extension;
		            $check=in_array($extension,$allowedfileExtension);
		            if($check){
		                $path     = $input['PDF']->move(public_path("/storage") , $filename);
		                $fileURL  = url('/storage/'. $filename);
		                $input['PDF'] = $fileURL;
		                $home = Home::create($input);
		            }
		        }else{
		    	        $home = Home::create($input);
		        }
	        return response()->json([ 'data'=>$home,'message'=>null , 'status' => 1]);
    }

    /**
  	 * @OA\Get(
  	 *     path="/display_home_details",
  	 *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="PDF title",
     *         required=true,
     *     ),
	 *     @OA\Response(response="200", description="display home details with title param")
	 *     )
     */
    public function display_home_details(Request $request){
    	$home = Home::where('title',$request->title)->first();

    	if($home !== null){
    		return response()->json(['data' => $home,'message'=>null,'status'=>1]);
    	}else{
            return response()->json(['data'=>null,'message' => 'title request is not found or wrong','status'=>0]);
    	}

    }
}
