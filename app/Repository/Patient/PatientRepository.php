<?php

namespace App\Repository\Patient;

use App\Interfaces\Patient\PatientRepositoryInterface;
use App\Models\Invoice;
use App\Models\Ray;
use App\Models\Laboratory;
use App\Models\Receipt;


class PatientRepository implements PatientRepositoryInterface
{
    public function invoices(){

        $invoices = Invoice::where('patient_id',auth()->user()->id)->get();
        return view('dashboard.patient.invoices',compact('invoices'));
    }

    public function laboratories(){

        $laboratories = Laboratory::where('patient_id',auth()->user()->id)->get();
        return view('dashboard.patient.laboratories',compact('laboratories'));
    }

    public function viewLaboratories($id){

        $laboratory = Laboratory::findorFail($id);
        if($laboratory->patient_id !=auth()->user()->id){
            return redirect()->route('404');
        }
        return view('dashboard.laboratory_emp.laboratories.show', compact('laboratory'));
    }

    public function rays(){

        $rays = Ray::where('patient_id',auth()->user()->id)->get();
        return view('dashboard.patient.rays',compact('rays'));
    }

    public function viewRays($id)
    {
        $ray = Ray::findorFail($id);
        if($ray->patient_id !=auth()->user()->id){
            return redirect()->route('404');
        }
        return view('dashboard.ray_emp.rays.show', compact('ray'));
    }

    public function payments(){

        $payments = Receipt::where('patient_id',auth()->user()->id)->get();
        return view('dashboard.patient.payments',compact('payments'));
    }
}
