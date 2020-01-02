<?php

namespace Modules\Workshop\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class WorkShopController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $rows = Workshop::all();
        return view('workshop::index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('workshop::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $data = $request->validate($rules);

        if($request->hasFile('icon')){
            $input['icon'] = $request->file('icon');
            $allowedfileExtension=['jpg','png','jpeg'];
            $extension = $input['icon']->getClientOriginalExtension();
            $filename =pathinfo($input['icon']->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = md5($filename . time()) .'.' . $extension;
            $check=in_array($extension,$allowedfileExtension);
            if($check){
                $path     = $input['icon']->move(public_path("/storage") , $filename);
                $fileURL  = url('/storage/'. $filename);
                $data['icon'] = $fileURL;
            }
        }

        $workshop = Workshop::create($data);
        Session::flash('message', 'Workshop Created Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('workshops.index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $row = Workshop::find($id);
        return view('workshop::edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
        ];
        $data = $request->validate($rules);

        if($request->hasFile('icon')){
            $input['icon'] = $request->file('icon');
            $allowedfileExtension=['jpg','png','jpeg'];
            $extension = $input['icon']->getClientOriginalExtension();
            $filename =pathinfo($input['icon']->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = md5($filename . time()) .'.' . $extension;
            $check=in_array($extension,$allowedfileExtension);
            if($check){
                $path     = $input['icon']->move(public_path("/storage") , $filename);
                $fileURL  = url('/storage/'. $filename);
                $data['icon'] = $fileURL;
            }
        }

        $workshop = Workshop::find($id)->update($data);
        Session::flash('message', 'Workshop Edited Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('workshops.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $workshop = Workshop::find($request->id);
        $workshop->delete();

        return response()->json(['id'=>1]);
    }
}
