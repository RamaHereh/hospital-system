<?php

namespace App\Repository\Doctor;
use App\Interfaces\Doctor\RayRepositoryInterface;
use App\Models\Ray;

class RayRepository implements RayRepositoryInterface
{

    public function store($request)
    {
        try {
            $laboratory = new Ray();
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
            $ray = Ray::findOrFail($id);
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
        $rays = Ray::findorFail($id);
        if($rays->doctor_id !=auth()->user()->id){
            //abort(404);
            return redirect()->route('404');
        }
        return view('dashboard.doctor.rays.show', compact('rays'));
    }

    public function destroy($id)
    {
        try {
            Ray::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
