<?php

namespace Modules\User\Http\Controllers;

use App\Gender;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $rows = User::all();
        return view('user::index',compact('rows'));
    }

    public function create()
    {
        $genders = Gender::all();
        return view('user::create',compact('genders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'gender_id' => 'required',
            'password' => 'required',
            'DOB' => 'required',
        ]);
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        Session::flash('message', 'User Added Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function edit($id)
    {
        $row = User::find($id);
        $genders = Gender::all();
        return view('user::edit',compact('genders','row'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'gender_id' => 'required',
            'DOB' => 'required',
        ]);
        if ($request->has('password')){
            $data['password'] = bcrypt($request->password);
        }
        $user = User::find($id)->update($data);

        Session::flash('message', 'User Edited Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('users.index');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return response()->json(['id' => $request->id]);
    }
}
