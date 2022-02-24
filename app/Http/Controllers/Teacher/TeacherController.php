<?php

namespace App\Http\Controllers\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\TeacherRepositoryInterface;
use App\Teacher;
use App\Http\Requests\StoreTeachers;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */
    protected  $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
            $this->Teacher = $Teacher;
    }
    public function index()
    {
        $Teachers = $this->Teacher->getAllTeacher();
        return view('pages.Teachers.Teachers',compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specializations = $this->Teacher->getSpec();
        $genders = $this->Teacher->getGender();
        return view('pages.Teachers.create' , compact('specializations' , 'genders'));
    }


    public function store(StoreTeachers $request)
    {
            return $this->Teacher->StoreTeachers($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
