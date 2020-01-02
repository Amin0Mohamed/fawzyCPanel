<?php

namespace Modules\Other\Http\Controllers;

use App\Chair;
use App\MainProgram;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class ChairController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $rows = Chair::all();
        $main_programs = MainProgram::all();
        return view('other::chairs.index',compact('rows','main_programs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $main_programs = MainProgram::all();
        return view('other::chairs.create',compact('main_programs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->validate([
            'main_program_id' => 'required',
            'name' => 'required'
        ]);

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

        $chair = Chair::create($data);
        Session::flash('message', 'Chair Created Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('chairs.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $main_programs = MainProgram::all();
        $row = Chair::find($id);
        return view('other::chairs.edit',compact('main_programs','row'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $data = $request->validate([
            'main_program_id' => 'required',
            'name' => 'required'
        ]);

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

        $chair = Chair::find($id)->update($data);
        Session::flash('message', 'Chair Edited Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('chairs.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $chair = Chair::find($request->id);
        $chair->delete();

        return response()->json(['data' => 'success']);
    }
}
