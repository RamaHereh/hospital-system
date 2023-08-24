<?php

namespace App\Repository\LaboratoryEmp;

use App\Interfaces\LaboratoryEmp\LaboratoryRepositoryInterface;
use App\Models\Laboratory;
use App\Traits\ImageTrait;

class LaboratoryRepository implements LaboratoryRepositoryInterface
{

    use ImageTrait;

    public function index()
    {
        $invoices = Laboratory::where('case',0)->get();
        return view('dashboard.laboratory_emp.laboratories.index',compact('invoices'));
    }

    public function completedLabs()
    {
        $invoices = Laboratory::where('case',1)->where('laboratory_emp_id',auth()->user()->id)->get();
        return view('dashboard.laboratory_emp.laboratories.completed-invoices',compact('invoices'));
    }

    public function edit($id)
    {
        $invoice = Laboratory::findorFail($id);
        return view('dashboard.laboratory_emp.laboratories.edit',compact('invoice'));
    }

    public function update($request, $id)
    {
        $invoice = Laboratory::findorFail($id);
        $invoice->laboratory_emp_id = auth()->user()->id;
        $invoice->description_emp = $request->description_employee;
        $invoice->case = 1;
        $invoice->save();

        if( $request->hasFile( 'photos' ) ) {
            foreach ($request->photos as $photo) {
                
                $this->storeImageRayAndLab($photo,'Laboratories','upload_image',$invoice->id,'App\Models\Laboratory');
            }
        }
        session()->flash('edit');
        return redirect()->route('laboratories.index');

    }

    public function show($id)
    {
        $laboratory = Laboratory::findorFail($id);
        if($laboratory->laboratory_emp_id !=auth()->user()->id){
            //abort(404);
            return redirect()->route('404');
        }
        return view('dashboard.laboratory_emp.laboratories.show', compact('laboratory'));
    }
}
