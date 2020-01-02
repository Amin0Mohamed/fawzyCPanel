<?php

namespace Modules\Faculty\Http\Controllers;

use App\Faculty;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $rows = Faculty::all();
        return view('faculty::index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('faculty::create');
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
            'info' => 'required',
            'description' => 'required',
        ];
        $data = $request->validate($rules);

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

        $faculty = Faculty::create($data);
        Session::flash('message', 'Faculty Created Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('faculties.index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $row = Faculty::find($id);
        return view('faculty::edit',compact('row'));
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
            'info' => 'required',
            'description' => 'required',
        ];
        $data = $request->validate($rules);

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

        $faculty = Faculty::find($id)->update($data);
        Session::flash('message', 'Faculty Edited Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('faculties.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $faculty = Faculty::find($request->id);
        $faculty->delete();

        return response()->json(['id'=>1]);
    }
}
