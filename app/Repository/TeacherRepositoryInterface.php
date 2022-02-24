<?php

namespace App\Repository;

interface TeacherRepositoryInterface{

    public function getAllTeacher();


    public function getGender();

    public function getSpec();

    public function StoreTeachers($request);

}
