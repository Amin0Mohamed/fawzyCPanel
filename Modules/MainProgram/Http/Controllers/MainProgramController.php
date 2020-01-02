<?php

namespace Modules\MainProgram\Http\Controllers;

use App\MainProgram;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class MainProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id)
    {
        $rows = MainProgram::where('program_id',$id)->get();
        $program = Program::find($id);
        return view('mainprogram::index',compact('rows','program'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        $program = Program::find($id);
        return view('mainprogram::create',compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'program_id'=>'required',
            'session_number'=>'required|numeric',
            'session_name'=>'required',
            'location'=>'required',
            'presenters'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ]);
        $mainprogram = MainProgram::create($data);
        Session::flash('message', 'Main Program Added Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('main.programs.index',$request->program_id);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('mainprogram::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $row = MainProgram::find($id);
        return view('mainprogram::edit',compact('row'));
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
            'session_number'=>'required|numeric',
            'session_name'=>'required',
            'location'=>'required',
            'presenters'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ]);
        $mainprogram = MainProgram::find($id);
        $mainprogram->update($data);
        Session::flash('message', 'Main Program edited Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('main.programs.index',$mainprogram->program_id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $main_program = MainProgram::find($request->id);
        $main_program->delete();
        return response()->json(['id' => $request->id]);
    }
}
