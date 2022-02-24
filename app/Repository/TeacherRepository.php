<?php

namespace App\Repository;

use App\Gender;
use App\Repository\TeacherRepositoryInterface;
use App\Specialization;
use App\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{
    public function getAllTeacher()
    {
        return Teacher::all();
    }

    public function getGender()
    {
        return Gender::all();
    }

    public function getSpec()
    {
        return Specialization::all();
    }

    public function StoreTeachers($request)
    {
        dd($request);
        // try{

        //     $Teacher = new Teacher();
        //     $Teacher->name = ['en' => $request->name_en , 'ar'=>$request->name_ar];
        //     $Teacher->email = $request->email;
        //     $Teacher->password = Hash::make($request->password);
        //     $Teacher->spec_id = $request->spec_id;
        //     $Teacher->gender_id = $request->gender_id;
        //     $Teacher->join_date = $request->join_date;
        //     $Teacher->address = $request->address;
        //     $Teacher->save();
        //     toastr()->success(trans('messages.success'));
        //     return redirect()->route('Teachers.create');

        // }catch (Exception $e) {
        //     return redirect()->back()->with(['error' => $e->getMessage()]);
        // }
    }
}
