<?php

namespace App\Repository\Doctor;

use App\Interfaces\Doctor\LaboratoryRepositoryInterface;
use App\Models\Laboratory;

class LaboratoryRepository implements LaboratoryRepositoryInterface
{

    public function store($request)
    {
        try {
            $laboratory = new Laboratory();
            $laboratory->description = $request->description;
            $laboratory->invoice_id = $request->invoice_id;
            $laboratory->patient_id = $request->patient_id;
            $laboratory->doctor_id = $request->doctor_id;
            $laboratory->save();
            
            session()->flash('add');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $laboratory = Laboratory::findOrFail($id);
            $ray->description = $request->description;
            $ray->save();
            
            session()->flash('edit');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $laboratories = Laboratory::findorFail($id);
        if($laboratories->doctor_id !=auth()->user()->id){
            //abort(404);
            return redirect()->route('404');
        }
        return view('dashboard.doctor.laboratories.show', compact('laboratories'));
    }

    public function destroy($id)
    {
        try {
            Laboratory ::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
