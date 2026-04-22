<?php

namespace App\Repository\Eloquent\Doctors;

use App\Interfaces\Doctors\DoctorsRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Doctor;
use App\Models\Section;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Hash;
class DoctorsRepository extends BaseRepository implements DoctorsRepositoryInterface
{
    use UploadTrait;
    /**
     * Create a new class instance.
     */
    public function __construct(Doctor $model)
    {
        parent::__construct($model);
    }


        public function index()
    {
        $doctors = $this->all();

       return view('dashboard.Doctors.index', compact('doctors'));
    }


    public function create_view()
    {
        $appointments = Appointment::all();
        $sections = Section::all();
        return view('dashboard.Doctors.add', compact('sections','appointments'));
    }


    public function store($request)
    {
        // dd($request->input('appointments'),$request->input('section_id'));
        DB::beginTransaction();
        try {
            $this->model = $this->create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')), // password
                'phone' => $request->input('phone'),
                'fees' => $request->input('fees'),
                'section_id' =>  $request->input('section_id'),
                'name' => $request->input('name'),
                'status' => 1,
            ]);
            $this->model->doctorappointments()->attach($request->appointments);
            $emailWithoutCom = str_replace('.com', '', $request->input('email'));
            // dd($emailWithoutCom);
            $img=$this->StoreImage($request,$emailWithoutCom,'photo','doctors','upload_image',$this->model->id,'App\Models\Doctor');
            // dd($img);
            DB::commit();
            session()->flash('add');

            return redirect()->route('doctors.index');
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit_view($id)
    {
        $appointments = Appointment::all();
        $sections = Section::all();
        $doctor = $this->find($id);
        return view('dashboard.Doctors.edit', compact('doctor','sections','appointments'));
    }

    public function edit($request)
    {
        DB::beginTransaction();

        try {

            $this->model = $this->update([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')), // password
                'phone' => $request->input('phone'),
                'fees' => $request->input('fees'),
                'section_id' =>  $request->input('section_id'),
                'name' => $request->input('name'),
                'status' => 1,
            ], $request->id);

            dd('pivot');
             // update pivot tABLE
            $this->model->doctorappointments()->sync($request->appointments);


            // update photo
            if ($request->has('photo')){
                // Delete old photo
                if ($this->model->image){
                    $old_img = $this->model->image->filename;
                    $this->Delete_attachment('upload_image','doctors/'.$old_img,$request->id);
                }
                //Upload img
                $emailWithoutCom = str_replace('.com', '', $request->input('email'));
                $this->StoreImage($request,$emailWithoutCom,'photo','doctors','upload_image',$request->id,'App\Models\Doctor');
            }
            // dd($request);
            DB::commit();
            session()->flash('edit');
            return redirect()->route('doctors.index');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        if($request->page_id==1){

            if($request->filename){

            $this->Delete_attachment('upload_image','doctors/'.$request->filename,$request->id,$request->filename);
            }
            $this->delete($request->id);
            session()->flash('delete');
            return redirect()->route('doctors.index');
        }

        //---------------------------------------------------------------

        else{
            // delete selector doctor
            $delete_select_id = explode(",", $request->delete_select_id);
            // dd($delete_select_id);
            foreach ($delete_select_id as $ids_doctors){
                $doctor = $this->findorfail($ids_doctors);
                if($doctor->image){
                    $this->Delete_attachment('upload_image','doctors/'.$doctor->image->filename,$ids_doctors);
                }
            }
            $this->delete($delete_select_id);
            session()->flash('delete');
            return redirect()->route('doctors.index');
        }


    }

    public function update_status($request)
    {
        try {
            $doctor = $this->findorfail($request->id);
            $this->update([ 'status'=> $request->input('status') ],$request->id);

            // dd($request->input('status'));
            session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        // $doctor = $this->findorfail($request->id);
        // $status = $doctor->status == 1 ? 0 : 1;
        // // dd($request->input('status'));
        // $this->update(['status' => $request->input('status')], $request->id);
        // $this->update(['status' => $status], $request->id);
        // session()->flash('edit');
        // return redirect()->back();
    }

    public function update_password($request)
    {
        try {
            $this->update(['password' => Hash::make($request->input('password'))], $request->id);
            session()->flash('edit');
            return redirect()->back();
            }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
