<?php

namespace App\Repository\Doctor;
use App\Interfaces\Doctor\InvoiceRepositoryInterface;
use App\Models\Invoice;
use App\Models\Laboratory;
use App\Models\Diagnosis;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function inProcessInvoices()
    {
        $invoices = Invoice::where('doctor_id',  Auth::user()->id)->where('invoice_status',1)->get();
        return view('dashboard.doctor.invoices.index',compact('invoices'));
    }

    public function reviewedInvoices()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 2)->get();
        return view('dashboard.doctor.invoices.review-invoices', compact('invoices'));
    }

    public function completedInvoices()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 3)->get();
        return view('dashboard.doctor.invoices.completed-invoices', compact('invoices'));
    }

    public function patientDetails($id){
        $patient_diagnoses = Diagnosis::where('patient_id',$id)->get();
        $patient_rays = Ray::where('patient_id',$id)->get();
        $patient_laboratories  = Laboratory::where('patient_id',$id)->get();
        return view('dashboard.doctor.invoices.patient-details',compact('patient_diagnoses','patient_rays','patient_laboratories'));
    }
}
