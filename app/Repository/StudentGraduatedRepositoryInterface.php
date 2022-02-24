<?php

namespace App\Repository;

interface StudentGraduatedRepositoryInterface{

    public function index();

    public function creat();

    public function sotDelete($request);

    public function destroy($request);
}

