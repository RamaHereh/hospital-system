<?php

namespace App\Repository\Admin;

use App\Interfaces\Admin\RayEmpRepositoryInterface;
use App\Models\RayEmp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RayEmpRepository implements RayEmpRepositoryInterface
{

    public function index()
    {
        $rayEmployees = RayEmp::all();
        return view('dashboard.admin.rays.index',compact('rayEmployees'));
    }

    public function store($request)
    {
        try {
            $rayEmployee = new RayEmp();
            $rayEmployee->name = $request->name;
            $rayEmployee->email =  $request->email;
            $rayEmployee->password = Hash::make($request->password);
            $rayEmployee->save();

            session()->flash('add');
            return back();

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        $rayEmployee = RayEmp::findorfail($id);
        $rayEmployee->name = $request->name;
        $rayEmployee->email =  $request->email;
        $rayEmployee->password = !empty($request->password) ? Hash::make($request->password) : DB::raw('password');
        $rayEmployee->save();

        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            RayEmp::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
