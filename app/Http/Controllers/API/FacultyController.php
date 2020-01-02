<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faculty;
use Validator;

class FacultyController extends Controller
{
     /**
  	 * @OA\Post(
  	 *     path="/insert_faculty",
  	 *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="faculty name",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="image",
     *         in="query",
     *         description="image of faculty",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="info",
     *         in="query",
     *         description="info of faculty",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="faculty description",
     *         required=true,
     *     ),
	 *     @OA\Response(response="200", description="insert faculty with above params")
	 * )
     */
       public function insert_faculty(Request $request){
		        $validator = Validator::make($request->all(), [
		            'name' => 'required',
		            'image' => 'required|image',
		            'info' => 'required|max:20',
		            'description' => 'required',
		        ]);
		        if ($validator->fails()) {
		            return response()->json(['data'=>null,'message'=>$validator->messages() , 'status' => 0]);
		        }
		        $input = $request->all();
		        if($request->hasFile('image')){
		            $input['image'] = $request->file('image');
		            $allowedfileExtension=['jpg','png','jpeg'];
		            $extension = $input['image']->getClientOriginalExtension();
		            $filename =pathinfo($input['image']->getClientOriginalName(), PATHINFO_FILENAME);
		            $filename = md5($filename . time()) .'.' . $extension;
		            $check=in_array($extension,$allowedfileExtension);
		            if($check){
		                $path     = $input['image']->move(public_path("/storage") , $filename);
		                $fileURL  = url('/storage/'. $filename);
		                $input['image'] = $fileURL;
		                $faculty = Faculty::create($input);
		            }
		        }else{
		    	        $faculty = Faculty::create($input);
		        }
	        return response()->json([ 'data'=>$faculty,'message' => null , 'status' => 1]);
       }


     /**
  	 * @OA\Get(
  	 *     path="/all_faculities",
	 *     @OA\Response(response="200", description="Get all faculties")
	 * )
     */

       public function all_faculities(){
       	  $faculties = Faculty::query()->select('name','image','info')->get();
       	  if ($faculties->count() > 0){
              return response()->json(['data' => $faculties,'message'=>null,'status'=>1]);
          }else{
              return response()->json(['data' => null,'message'=>'there is no data','status'=>0]);
          }

       }


     /**
  	 * @OA\Get(
  	 *     path="/get_faculty",
  	 *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="faculty id",
     *         required=true,
     *     ),
	 *     @OA\Response(response="200", description="get one faculty with its id")
	 * )
     */


       public function get_faculty(Request $request){
       	 $faculty = Faculty::where('id' , $request->id)->first();
       	 if ($faculty !== null){
             return response()->json(['data' => $faculty,'message'=>null,'status'=>1]);
         }else{
             return response()->json(['data' => $faculty,'message'=>'make sure send correct id request','status'=>0]);
         }
       }






}
