<?php
namespace App\Repository\Admin;

use App\Interfaces\Admin\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Section;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use ImageTrait;

    public function index()
    {
        $doctors = Doctor::with('doctorappointments')->get();
        return view('dashboard.admin.doctors.index',compact('doctors'));
    }

    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('dashboard.admin.doctors.create',compact('sections','appointments'));
    }

    public function store($request){

        DB::beginTransaction();

        try {
            $doctor = new Doctor();
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->password = Hash::make($request->password);
            $doctor->section_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->status = 1;
            $doctor->save();

            $doctor->doctorappointments()->attach($request->appointments);
                  
            if( $request->hasFile( 'photo' ) ) {
                    
                $this->storeImageDoctor($request->photo,$doctor->name,'doctors','upload_image',$doctor->id,'App\Models\Doctor');    
            }  

            DB::commit();
            session()->flash('add');
            return redirect()->route('doctors.index');
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        $doctor = Doctor::findorfail($id);
        return view('dashboard.admin.doctors.edit',compact('sections','appointments','doctor'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->section_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->save();

            $doctor->doctorappointments()->sync($request->appointments);

            if ($request->photo){
                if ( $request->hasFile( 'photo' ) ){
                    $oldImg = $doctor->image->filename;
                    $this->deleteImage('upload_image','doctors/'.$oldImg,$request->id);
                }
                $this->storeImageDoctor($request->photo,$doctor->name,'doctors','upload_image',$doctor->id,'App\Models\Doctor'); 
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->route('doctors.index');
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        if($request->page_id==1){
            if($request->photo){
             $this->deleteImage('upload_image','doctors/'.$request->photo,$request->id);
            }
             Doctor::destroy($request->id);
             session()->flash('delete');
             return redirect()->route('doctors.index');
        }
        else{

            $doctorsId = explode(",", $request->delete_select_id);
            foreach ($doctorsId as $doctorId){
            $doctor = Doctor::findorfail($doctorId);
            if($doctor->image){
                $this->deleteImage('upload_image','doctors/'.$doctor->image->filename,$doctorId);
            }
          }
          Doctor::destroy($doctorsId);
          session()->flash('delete');
          return redirect()->route('doctors.index');
      }
    }

    public function updatePassword($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->password = Hash::make($request->password);
            $doctor->save();

            session()->flash('edit');
            return back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateStatus($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->status = $request->status;
            $doctor->save();

            session()->flash('edit');
            return redirect()->route('doctors.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
