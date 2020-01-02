<?php

namespace Modules\Admin\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function get_login()
    {
        if (auth()->guard('admin')->check()){
            return redirect()->route('admins.index');
        }else{
            return view('admin::login');
        }
    }

    public function post_login(Request $request)
    {
            if (auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('admins.index');
            }else{
                Session::flash('message', 'Invalid Email or Password');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin_get');
    }

    public function index()
    {
        $rows = Admin::all();
        return view('admin::index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $data['password'] = bcrypt($request->password);
        $user = Admin::create($data);

        Session::flash('message', 'Admin Added Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $row = Admin::find($id);
        return view('admin::edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        if ($request->has('password')){
            $data['password'] = bcrypt($request->password);
        }
        $user = Admin::find($id)->update($data);

        Session::flash('message', 'Admin Edited Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->delete();
        return response()->json(['id' => $request->id]);
    }
}
