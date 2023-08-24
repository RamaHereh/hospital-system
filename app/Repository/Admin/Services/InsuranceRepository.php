<?php


namespace App\Repository\Admin\Services;

use App\Interfaces\Admin\Services\InsuranceRepositoryInterface;
use App\Models\Insurance;

class InsuranceRepository implements InsuranceRepositoryInterface
{

    public function index()
    {
        $insuranceCompanies = Insurance::all();
        return view('dashboard.admin.services.insurance_companies.index', compact('insuranceCompanies'));
    }

    public function create()
    {
        return view('dashboard.admin.services.insurance_companies.create');
    }

    public function store($request)
    {
        $insuranceCompany = new Insurance();
        $insuranceCompany->name = $request->name;
        $insuranceCompany->insurance_code = $request->insurance_code;
        $insuranceCompany->discount_percentage = $request->discount_percentage;
        $insuranceCompany->company_rate = $request->company_rate;
        $insuranceCompany->notes = $request->notes;
        $insuranceCompany->status = 1;
        $insuranceCompany->save();  

        session()->flash('add');
        return redirect()->route('insurance_companies.index');
        
    }

    public function edit($id)
    {
        $insuranceCompany = Insurance::findorfail($id);
        return view('dashboard.admin.services.insurance_companies.edit', compact('insuranceCompany'));
    }

    public function update($request, $id)
    {
        $insuranceCompany = Insurance::findOrFail($id);
        $insuranceCompany->name = $request->name;
        $insuranceCompany->insurance_code = $request->insurance_code;
        $insuranceCompany->discount_percentage = $request->discount_percentage;
        $insuranceCompany->company_rate = $request->company_rate;
        $insuranceCompany->notes = $request->notes;
        $insuranceCompany->status = $request->status ?: 0;
        $insuranceCompany->save();

        session()->flash('edit');
        return redirect()->route('insurance_companies.index');
    }

    public function destroy($id)
    {
        Insurance::destroy($id);
        session()->flash('delete');
        return redirect()->route('insurance_companies.index');
    }

}
