<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use App\User;
use App\OauthAccessToken;
use Validator;

class UserController extends Controller
{

    /**
	 * @OA\Info(title="User login and register", version="0.1")
	 *
   * @OA\Server(
   *     description="Base URL",
   *     url="http://165.22.71.144/uears_web/public/api"
   * )
   */

  	/**
  	 * @OA\Post(
  	 *     path="/login",
  	 *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="user registered email",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="user Password",
     *         required=true,
     *     ),
	   *     @OA\Response(response="200", description="login with email and password")
	   * )
     */

    public function login(Request $request){

        if(auth()->attempt(['email'=>$request->email,'password'=>$request->password])){

            return response()->json(['data'=> auth()->user(),'message' => null , 'status' => 1]);
        }else{
            return response()->json(['data'=> null,'message'=>'invalid username or password' , 'status' => 0]);
        }
    }


    /**
	 * @OA\Post(
	 *     path="/register",
	 *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="username",
     *         required=true,
     *     ),
	 *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="user registered email",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="user Password",
     *         required=true,
     *     ),
           @OA\Parameter(
     *         name="gender_id",
     *         in="query",
     *         description="gender_id should be 1 for a male , 2 for a female",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="DOB",
     *         in="query",
     *         description="user registered email",
     *         required=true,
     *     ),
	 *     @OA\Response(response="200", description="Register a new user with the above params")
	 * )
    */



    public function register(Request $request){
       $validator = Validator::make($request->all(),[
       'email'=>'required|unique:users',
       'name'=>'required',
       'password'=>'required',
       'gender_id'=>'required|integer',
       'DOB'=>'required'
       ]);


       if($validator->fails()){
       	 return response()->json(['message' => $validator->errors()->first(),'data'=>null, 'status' => 0]);
       }else{
       	$data = $request->all();
       	$data['password'] = bcrypt($request->password);
       	$user = User::create($data);
       	return response()->json(['message' => null , 'data' => $user , 'status' => 1]);
       }

    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id'=>'required',
            'email'=>'unique:users,email,'.$request->user_id
        ]);

        if ($validator->fails()){
            return response()->json(['data'=>null,'message'=>$validator->messages(),'status'=>0]);
        }else{
            $user = User::find($request->user_id);
            if($user == null){
                return response()->json(['data'=>null,'message'=>'the user_id is invalid','status'=>0]);
            }else{
                $data = [];
                if ($request->has('name')){
                    $data['name'] = $request->name;
                }
                if ($request->has('email')){
                    $data['email'] = $request->email;
                }
                if ($request->has('password')){
                    $data['password'] = bcrypt($request->password);
                }
                if ($request->has('email')){
                    $data['email'] = $request->email;
                }
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
                        $data['image'] = $fileURL;
                    }
                }
                $user->update($data);
                return response()->json(['data'=>$user,'message'=>null,'status'=>1]);

            }
        }

    }

    public function settings()
    {
        $settings = Setting::all();

        return response()->json(['data' => $settings,'message'=>null,'status'=>1]);
    }

}
