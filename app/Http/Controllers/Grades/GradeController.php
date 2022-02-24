<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Grade;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades' , compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Grade::where('name->ar', $request->name)->orWhere('name->en',$request->name_en)->exists()) {

            return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        }



        try{
            $request->validate([
                'name' => 'required|unique:grades,name',
                'notes' => 'nullable'
            ]);
            $grade  = new Grade();
            $grade->name = ['en' => $request->name_en , 'ar' => $request->name ];
            $grade->notes = $request->notes;
            $grade->save();
            toastr()->success(trans("Grades_trans.add_Grade_success"));
            return back();
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'name' => 'required|unique:grades,name',
            'notes' => 'nullable'
        ]);
        $grade->name = ['en' => $request->name_en , 'ar' => $request->name ];
        $grade->notes = $request->notes;
        $grade->save();
        toastr()->success(trans("Grades_trans.edit_Grade_success"));
        return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        toastr()->success(trans("Grades_trans.delete_Grade_success"));
        return back();
    }

    public function Get_teacher($id)
    {
        $list_teacher = Teacher::where("grade_id" ,$id)->pluck("name",'id');
        return $list_teacher;
    }

    public function Get_teacherSpec($id , $grade_id)
    {
        $list_teacher = Teacher::where("spec_id" ,$id)->where('grade_id' , $grade_id)->pluck("name",'id');
        return $list_teacher;
    }

}
