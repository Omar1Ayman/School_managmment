<?php

namespace App\Repository;

interface FeesRepositoryInterface{

    public function index();

    public function create();

    public function strore($request);

    public function edit($id);

    public function update($request);

    public function destroy($request);

    public function show($id);
}
