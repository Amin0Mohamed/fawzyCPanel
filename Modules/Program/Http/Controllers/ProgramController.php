<?php

namespace Modules\Program\Http\Controllers;

use App\MainProgram;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class ProgramController extends Controller
{
    public function index()
    {
        $rows = Program::all();
        return view('program::index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('program::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required',
        ]);

        $program = Program::create($data);

        Session::flash('message', 'Program Added Successfully');
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
        $row = Program::find($id);
        return view('program::edit',compact('row'));
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
            'date' => 'required',
        ]);

        $program = Program::find($id)->update($data);

        Session::flash('message', 'Program Edited Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('programs.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $program = Program::find($request->id);
        $program->delete();

        $mainProgram = MainProgram::where('program_id',$program->program_id);
        $mainProgram->delete();
        return response()->json(['id' => $request->id]);
    }
}
