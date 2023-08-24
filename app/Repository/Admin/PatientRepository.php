<?php


namespace App\Repository\Admin;
use App\Interfaces\Admin\PatientRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;

class PatientRepository implements PatientRepositoryInterface
{
   public function index()
   {
       $patients = Patient::all();
       return view('dashboard.admin.patients.index',compact('patients'));
   }

    public function show($id)
    {
        $patient = patient::findorfail($id);
        $debts = $patient->debtAccounts;
        $payments = $patient->cashAccounts;
        //dd($payments);
        return view('dashboard.admin.patients.show', compact('patient', 'debts', 'payments'));
    }

    public function create()
   {
       return view('dashboard.admin.patients.create');
   }

   public function store($request)
   {
       try {

           $patient = new Patient();
           $patient->name = $request->name;
           $patient->email = $request->email;
           $patient->password = Hash::make($request->phone);
           $patient->address = $request->address;
           $patient->date_birth = $request->date_birth;
           $patient->phone = $request->phone;
           $patient->gender = $request->gender;
           $patient->blood_Group = $request->blood_group;
           $patient->save();
     
           session()->flash('add');
           return redirect()->route('patients.index');
       }

       catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
   }

   public function edit($id)
   {
       $patient = Patient::findorfail($id);
       return view('dashboard.admin.patients.edit',compact('patient'));
   }

   public function update($request, $id)
   {
       $patient = Patient::findOrFail($request->id);
       $patient->name = $request->name;
       $patient->email = $request->email;
       $patient->password = Hash::make($request->phone);
       $patient->address = $request->address;
       $patient->date_birth = $request->date_birth;
       $patient->phone = $request->phone;
       $patient->gender = $request->gender;
       $patient->blood_group = $request->blood_group;
       $patient->save();

       session()->flash('edit');
       return redirect()->route('patients.index');
   }

   public function destroy($id)
   {
       Patient ::destroy($id);
       session()->flash('delete');
       return redirect()->route('patients.index');
   }
}
