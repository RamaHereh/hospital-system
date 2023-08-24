<?php


namespace App\Repository\Admin\Services;

use App\Interfaces\Admin\Services\AmbulanceRepositoryInterface;
use App\Models\Ambulance;


class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index()
    {
        $ambulances = Ambulance::all();
        return view('dashboard.admin.services.ambulances.index',compact('ambulances'));
    }

    public function create()
    {
        return view('dashboard.admin.services.ambulances.create');
    }

    public function store($request)
    {
        $ambulance = new Ambulance();
        $ambulance->driver_name = $request->driver_name;
        $ambulance->notes = $request->notes;
        $ambulance->car_number = $request->car_number;
        $ambulance->car_model = $request->car_model;
        $ambulance->car_year_made = $request->car_year_made;
        $ambulance->driver_license_number = $request->driver_license_number;
        $ambulance->driver_phone = $request->driver_phone;
        $ambulance->is_available = 1;
        $ambulance->car_type = $request->car_type;
        $ambulance->save();

      session()->flash('add');
      return redirect()->route('ambulances.index');
    }

    public function edit($id)
    {
        $ambulance = Ambulance::findorfail($id);
        return view('dashboard.admin.services.ambulances.edit',compact('ambulance'));
    }

    public function update($request,$id)
    {
        $ambulance = Ambulance::findOrFail($id);
        $ambulance->driver_name = $request->driver_name;
        $ambulance->notes = $request->notes;
        $ambulance->car_number = $request->car_number;
        $ambulance->car_model = $request->car_model;
        $ambulance->car_year_made = $request->car_year_made;
        $ambulance->driver_license_number = $request->driver_license_number;
        $ambulance->driver_phone = $request->driver_phone;
        $ambulance->is_available = $request->is_available?: 0;
        $ambulance->car_type = $request->car_type;
        $ambulance->save();

        session()->flash('edit');
        return redirect()->route('ambulances.index');
    }

    public function destroy($id)
    {
        Ambulance ::destroy($id);
        session()->flash('delete');
        return redirect()->route('ambulances.index');
    }
}
