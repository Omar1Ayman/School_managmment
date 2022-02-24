<?php

namespace App\Http\Controllers\Student;
use App\Repository\StudentRepositoryinterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    protected $Student;

    public function __construct(StudentRepositoryinterface $Student)
    {
        $this->Student = $Student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $this->Student->getAllStudent();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->Student->Create_Student();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        return $this->Student->Store_Student($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->Student->attachment($id);
    }


    public function edit($id)
    {
        return $this->Student->edit($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStudentRequest  $request)
    {
        return $this->Student->Update_Student($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->Student->Delete_student($id);
    }


    public function Get_classrooms($id){
        return $this->Student->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }

    public function Upload_attachment(Request $request)
    {
        return $this->Student->Upload_attachment($request);
    }

    public function Download_attachment($studentsname , $filename)
    {
        return $this->Student->Download_attachment($studentsname , $filename);
    }

    public function Delete_attachment(Request $request)
    {
        return $this->Student->Delete_attachment($request);
    }

    public function open_attachment($studentsname , $filename)

    {
        return $this->Student->open_attachment($studentsname , $filename);
    }
}
