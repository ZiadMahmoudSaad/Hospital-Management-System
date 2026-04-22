<?php

namespace App\Interfaces\Services;

interface ServiceRepositoryInterface
{
    public function index();

    public function show($id);
    public function store($request);
    public function edit($request);
    public function destroy($id);
}
