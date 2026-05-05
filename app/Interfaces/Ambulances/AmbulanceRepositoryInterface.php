<?php

namespace App\Interfaces\Ambulances;

interface AmbulanceRepositoryInterface
{
    public function index();

    public function create_view();

    public function store($request);

    public function edit_view($id);
    public function edit($request);

    public function destroy($id);
}
