<?php

namespace App\Repository\Eloquent\Patients;

use App\Repository\Eloquent\BaseRepository;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
class PatientRepository extends BaseRepository implements PatientRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Patient $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $Patients = $this->all();
        return view('Dashboard.Patients.index',compact('Patients'));
    }

    public function Show($id)
    {
        $Patient = patient::findorfail($id);
        // $invoices = Invoice::where('patient_id', $id)->get();
        // $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        // $Patient_accounts = PatientAccount::where('patient_id', $id)->get();

        return view('Dashboard.Patients.show', compact('Patient'));
        // return view('Dashboard.Patients.show', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'));
    }
        public function create_view()
    {

        return view('dashboard.Patients.create');
    }

    public function store($request)
    {
        try {
            $Patient = $this->create([
                'email' => $request->input('email'),
                'Password' =>  Hash::make($request->Phone),
                'Date_Birth' => $request->input('Date_Birth'),
                'Phone' => $request->input('Phone'),
                'Gender' => $request->input('Gender'),
                'Blood_Group' => $request->input('Blood_Group'),
                //insert trans
                'name' => $request->input('name'),
                'Address' => $request->input('Address'),
            ]);



            session()->flash('add');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit_view($id)
    {
        $Patient = Patient::findorfail($id);
        return view('dashboard.Patients.edit',compact('Patient'));
    }

    public function edit($request)
    {
        if (!$request->has('is_available'))
            $request->request->add(['is_available' => 2]);
        else
            $request->request->add(['is_available' => 1]);

        try {
            // dd($request->all());
            // Update Patient car data and notes
            $this->update([
                'email' => $request->input('email'),
                'Password' =>  Hash::make($request->Phone),
                'Date_Birth' => $request->input('Date_Birth'),
                'Phone' => $request->input('Phone'),
                'Gender' => $request->input('Gender'),
                'Blood_Group' => $request->input('Blood_Group'),
                //insert trans
                'name' => $request->input('name'),
                'Address' => $request->input('Address'),
            ], $request->id);



            session()->flash('edit');
            return redirect()->route('Patients.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($id)
    {
        Patient ::destroy($id);
        session()->flash('delete');
        return redirect()->back();
    }
}
