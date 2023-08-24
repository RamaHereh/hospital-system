<?php

namespace App\Repository\Admin;

use App\Interfaces\Admin\LaboratoryEmpRepositoryInterface;
use App\Models\LaboratoryEmp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LaboratoryEmpRepository implements LaboratoryEmpRepositoryInterface
{

    public function index()
    {
        $laboratoryEmps = LaboratoryEmp::all();
        return view('dashboard.admin.laboratories.index',compact('laboratoryEmps'));
    }

    public function store($request)
    {
        try {

            $laboratoryEmp = new LaboratoryEmp();
            $laboratoryEmp->name = $request->name;
            $laboratoryEmp->email = $request->email;
            $laboratoryEmp->password = Hash::make($request->password);
            $laboratoryEmp->save();

            session()->flash('add');
            return back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        $laboratoryEmp = LaboratoryEmp::findorfail($id);
        $laboratoryEmp->name = $request->name;
        $laboratoryEmp->email = $request->email;
        $laboratoryEmp->password =  !empty($request->password) ? Hash::make($request->password) : DB::raw('password');
        $laboratoryEmp->save();

        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            LaboratoryEmp::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
