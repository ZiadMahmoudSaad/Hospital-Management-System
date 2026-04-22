<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSingleServiceRequest;
use Illuminate\Http\Request;
use App\Interfaces\Services\ServiceRepositoryInterface;

class SingleServiceController extends Controller
{


    private $SingleService;

    public function __construct(ServiceRepositoryInterface $SingleService)
    {
        $this->SingleService = $SingleService;
        // $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->SingleService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSingleServiceRequest $request)
    {
        return $this->SingleService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         return $this->SingleService->edit($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->SingleService->destroy($request);
    }
}
