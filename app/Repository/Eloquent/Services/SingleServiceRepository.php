<?php

namespace App\Repository\Eloquent\Services;
use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Models\Service;
use App\Repository\Eloquent\BaseRepository;
class SingleServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $services= $this->all();
        return view('dashboard.Services.Single Service.index',compact('services'));
    }

    public function show($id)
    {

    }
    public function store($request)
    {
        try {
            $this->model = $this->create([
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'status' => 1,
                // store trans
                'name' => $request->input('name'),
                ]);



            session()->flash('add');
            return redirect()->route('Service.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($request)
    {
        try {
            $this->model = $this->update([
                'price' => $request->price,
                'description' => $request->description, // password
                'status' => $request->status,
                // store trans
                'name' => $request->name,
            ], $request->id);

            session()->flash('edit');
            return redirect()->route('Service.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function destroy($request)
    {
            $this->delete($request->id);
            session()->flash('delete');
            return redirect()->route('Service.index');
    }
}
