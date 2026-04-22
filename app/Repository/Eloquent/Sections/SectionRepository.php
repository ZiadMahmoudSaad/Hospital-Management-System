<?php

namespace App\Repository\Eloquent\Sections;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Section;
class SectionRepository extends BaseRepository implements SectionRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Section $model)
    {
        parent::__construct($model);
    }


    public function index()
    {
        $sections = $this->all();

       return view('dashboard.sections.index', compact('sections'));
    }

    public function show($id)
    {
        $doctors = $this->findorfail($id)->doctors;
        $section = $this->findorfail($id);

       return view('dashboard.sections.show_doctors', compact('doctors','section'));
    }


       /**
    * @return Collection
    */


    public function store($request)
    {
        $this->create([
            'name' => $request->input('name'),
        ]);

        session()->flash('add');
        return redirect()->route('sections.index');
    }

        public function edit($request)
    {
        $this->update([
            'name' => $request->input('name'),
        ], $request->id);
        // dd($request);
        session()->flash('edit');
        return redirect()->route('sections.index');
    }

    public function destroy($id)
    {
        $this->delete($id);
        session()->flash('delete');
        return redirect()->route('sections.index');
    }
}
