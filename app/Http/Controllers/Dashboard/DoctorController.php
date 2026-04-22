<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Interfaces\Doctors\DoctorsRepositoryInterface;
use App\Http\Requests\StoreDoctorRequest;
class DoctorController extends Controller
{
    private $doctor;

    public function __construct(DoctorsRepositoryInterface $doctor)
    {
        $this->doctor = $doctor;
        // $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->doctor->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->doctor->create_view();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        return $this->doctor->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
    */
    public function edit($id)
    {
        return $this->doctor->edit_view($id);
    }

    public function update(Request $request)
    {
        // dd($request);
        return $this->doctor->edit($request);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->doctor->destroy($request);
    }

    public function update_status(Request $request)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);
        return $this->doctor->update_status($request);
    }

    public function update_password(Request $request)
    {
        // dd('ok');
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        return $this->doctor->update_password($request);
    }
}
