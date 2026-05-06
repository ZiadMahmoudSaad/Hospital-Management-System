<?php

namespace App\Interfaces\Patients;

interface PatientRepositoryInterface
{
    public function index();

    public function Show($id);

    public function create_view();

    public function store($request);

    public function edit_view($id);
    public function edit($request);

    public function destroy($id);
}
