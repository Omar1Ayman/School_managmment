<?php

namespace App\Repository;

interface StudentRepositoryinterface{


    //Get all Students
    public function getAllStudent();


    //Create Student
    public function Create_Student();

    // Get Classrooms
    public function Get_classrooms($id);

    //Get Sections
    public function Get_Sections($id);

    //Store_Student
    public function Store_Student($request);

    //Edit Student
    public function edit($id);

    //Update Student
    public function Update_Student($id);

    //Delete Students
    public function Delete_student($id);

    //Student Attachment
    public function attachment($id);

    //Upload Attachments
    public function Upload_attachment($request);

    //Delete Attachment
    public function Delete_attachment($request);

    //Downlowad Attachment
    public function Download_attachment($studentsname , $filename);

    //Open Attachment
    public function open_attachment($studentsname , $filename);





}
