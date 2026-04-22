<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Sections\SectionRepositoryInterface;
class SectionController extends Controller
{

 private $section;

    public function __construct(SectionRepositoryInterface $section)
    {
        $this->section = $section;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->section->index();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->section->show($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->section->store($request);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->section->edit($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->section->destroy($request->id);
    }
}
