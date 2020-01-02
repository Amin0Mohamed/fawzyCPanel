<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Venue;

class VenueController extends Controller
{

	/**
  	 * @OA\Post(
  	 *     path="/insert_venue",
  	 *     @OA\Parameter(
     *         name="latitude",
     *         in="query",
     *         description="location latitude",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="longitude",
     *         in="query",
     *         description="location longitude",
     *         required=true,
     *     ),
           @OA\Parameter(
     *         name="location",
     *         in="query",
     *         description="location as a string",
     *         required=true,
     *     ),
           @OA\Parameter(
     *         name="mobile",
     *         in="query",
     *         description="mobile phone number of location",
     *         required=true,
     *     ),
          @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="description of location",
     *         required=true,
     *     ),
	 *     @OA\Response(response="200", description="insert a new location with above inputs")
	 * )
    */
    public function insert_venue(Request $request){
        $validator = Validator::make($request->all(),[
            'latitude'    => 'required|max:255|unique:venues',
            'longitude'   => 'required|max:255|unique:venues',
            'location'    => 'required|max:255',
            'mobile'      => 'required|max:255',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['data'=> null,'message' => $validator->messages(), 'status' => 0]);
        }else{
            $inputs = $request->all();
            $venue  = Venue::create($inputs);
            if($venue){
               return response()->json(['data'=>$venue,'message' => null, 'status' => 1]);
            }
        }
    }

    /**
  	 * @OA\Get(
  	 *     path="/display_venue",
  	 *     @OA\Parameter(
     *         name="latitude",
     *         in="query",
     *         description="location latitude",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="longitude",
     *         in="query",
     *         description="location longitude",
     *         required=true,
     *     ),
	 *     @OA\Response(response="200", description="display a specific venue")
	 * )
    */

    public function display_venue(Request $request){

    	$longitude = $request->longitude;
    	$latitude  = $request->latitude;

    	$venues = Venue::where(['longitude'=>$longitude , 'latitude' => $latitude ])->first();
        if($venues !== null){
           return response()->json(['data' => $venues ,'message' => 'there is no data','status' => 1]);
        }else{
           return response()->json(['data'=> null,'message' => 'check longitude and attitude and try again' ,'status' => 0]);
        }

    }










}
