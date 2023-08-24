<?php

namespace App\Repository\RayEmp;

use App\Interfaces\RayEmp\RayRepositoryInterface;
use App\Models\Ray;
use App\Traits\ImageTrait;

class RayRepository implements RayRepositoryInterface
{
    use ImageTrait;

   public function index()
   {
       $invoices = Ray::where('case',0)->get();
       return view('dashboard.ray_emp.rays.index',compact('invoices'));
   }

   public function completedRays()
   {
       $invoices = Ray::where('case',1)->where('ray_emp_id',auth()->user()->id)->get();
       return view('dashboard.ray_emp.rays.completed-invoices',compact('invoices'));
   }

    public function edit($id)
   {
       $invoice = Ray::findorFail($id);
       return view('dashboard.ray_emp.rays.edit',compact('invoice'));
   }

   public function update($request, $id)
   {
       
       $invoice = Ray::findorFail($id);
       $invoice->ray_emp_id = auth()->user()->id;
       $invoice->description_emp = $request->description_employee;
       $invoice->case = 1;
       $invoice->save();

       if( $request->hasFile( 'photos' ) ) {

        foreach ($request->photos as $photo) {
    
             $this->storeImageRayAndLab($photo,'Rays','upload_image',$invoice->id,'App\Models\Ray');
        }

       }
       session()->flash('edit');
       return redirect()->route('rays.index');
   }

   public function show($id)
   {
       $ray = Ray::findorFail($id);
       if($ray->ray_emp_id !=auth()->user()->id){
           //abort(404);
           return redirect()->route('404');
       }
       return view('dashboard.ray_emp.rays.show', compact('ray'));
   }

}
