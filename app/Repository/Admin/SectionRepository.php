<?php
namespace App\Repository\Admin;

use App\Interfaces\Admin\SectionRepositoryInterface;
use App\Models\Doctor;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
      $sections = Section::all();
      return view('dashboard.admin.sections.index',compact('sections'));
    }

    public function show($id)
    {
        $section = Section::findOrFail($id);   
        return view('dashboard.admin.sections.show-doctors',compact('section'));
    }

    public function store($request)
    {
        $section = new Section();
        $section->name =$request->name;
        $section->save();

        session()->flash('add');
        return back();
    }

    public function update($request, $id)
    {
        $section = Section::findOrFail($id);
        $section->name =$request->name;
        $section->save();

        session()->flash('edit');
        return back();
    }


    public function destroy($id)
    {
        Section::findOrFail($id)->delete();
        session()->flash('delete');
        return back();
    }

}
