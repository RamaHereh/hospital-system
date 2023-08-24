<?php

namespace App\Repository\Doctor;

use App\Interfaces\Doctor\DiagnosisRepositoryInterface;
use App\Models\Diagnosis;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class DiagnosisRepository implements DiagnosisRepositoryInterface
{
    public function store($request)
    {
        DB::beginTransaction();

        try {
            
            Invoice::findorFail($request->invoice_id)->update([
                'invoice_status'=>3
            ]);

            $diagnosis = new Diagnosis();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function addReview($request)
    {
        DB::beginTransaction();
        try {

            Invoice::findorFail($request->invoice_id)->update([
                'invoice_status'=>2
            ]);

            $diagnosis = new Diagnosis();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->review_date = date('Y-m-d H:i:s');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $patientDiagnoses = Diagnosis::where('patient_id',$id)->get();
        return view('dashboard.doctor.diagnoses.patient-record',compact('patientDiagnoses'));
    }

}
