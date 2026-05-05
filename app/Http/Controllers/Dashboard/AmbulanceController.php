<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Http\Requests\StoreAmbulanceRequest;
class AmbulanceController extends Controller
{

    private $Ambulance;
    /**
     * Display a listing of the resource.
     */
    public function __construct(AmbulanceRepositoryInterface $Ambulance)
    {
        $this->Ambulance = $Ambulance;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Ambulance->index();
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Ambulance->create_view();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmbulanceRequest $request)
    {
        return $this->Ambulance->store($request);
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
        return $this->Ambulance->edit_view($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Ambulance->edit($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Ambulance->destroy($request->id);
    }
}
