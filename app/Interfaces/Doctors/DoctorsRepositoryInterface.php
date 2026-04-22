<?php

namespace App\Interfaces\Doctors;

interface DoctorsRepositoryInterface
{
    public function index();

    public function create_view();

    public function store($request);

    public function edit_view($id);
    public function edit($request);

    public function destroy($id);

    public function update_password($request);

    public function update_status($request);
}
