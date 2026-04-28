<?php

namespace App\Repository\Eloquent\Insurances;
use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Insurance;
class InsuranceRepository extends BaseRepository implements InsuranceRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Insurance $model)
    {
        parent::__construct($model);
    }


    public function index()
    {
        $insurances = $this->all();

       return view('dashboard.insurances.index', compact('insurances'));
    }




       /**
    * @return Collection
    */

    public function create_view()
    {

        return view('dashboard.insurances.create');
    }
    public function store($request)
    {
        try {
            $this->model = $this->create([
                'insurance_code' => $request->input('insurance_code'),
                'discount_percentage' => $request->input('discount_percentage'),
                'Company_rate' => $request->input('Company_rate'),
                'status' => 1,
                // store trans
                'name' => $request->input('name'),
                'notes' => $request->input('notes'),
                ]);

            session()->flash('add');
            return redirect()->route('insurance.create');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit_view($id)
    {
        $insurances = $this->find($id);
        return view('dashboard.insurances.edit', compact('insurances'));
    }
    public function edit($request)
    {
        if (!$request->has('status'))
            $request->request->add(['status' => 0]);
        else
            $request->request->add(['status' => 1]);

        try {
            $this->model = $this->update([
                'insurance_code' => $request->input('insurance_code'),
                'discount_percentage' => $request->input('discount_percentage'),
                'Company_rate' => $request->input('Company_rate'),
                'status' => $request->input('status'),
                // store trans
                'name' => $request->input('name'),
                'notes' => $request->input('notes'),
            ], $request->id);

            session()->flash('edit');
            return redirect()->route('insurance.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        // dd( $id);
        $this->delete($id);
        session()->flash('delete');
        return redirect()->route('insurance.index');
    }
}
