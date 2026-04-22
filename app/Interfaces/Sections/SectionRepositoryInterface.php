<?php

namespace App\Interfaces\Sections;

interface SectionRepositoryInterface
{

    public function index();

    public function show($id);
    public function store($request);
    public function edit($request);
    public function destroy($id);
}
