<?php

namespace App\Repository;

use App\Grade;
use App\Student;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface{

    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.graduated.index' , compact('students'));
    }

    public function creat()
    {
        $Grades = Grade::all();
        return view('pages.Students.graduated.create' , compact('Grades'));
    }


    public function sotDelete($request)
    {
        $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();
        if($students->count() < 0){
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }
        foreach($students as $student){
            $ids = explode(',' , $student->id);
            Student::whereIn('id' , $ids)->Delete();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Graduated.index');
    }


    public function destroy($request)
    {
        Student::onlyTrashed()->where('id' , $request->student_id)->first()->forceDelete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();

    }



}
