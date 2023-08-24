<?php

namespace App\Http\Livewire;

use App\Events\CreateInvoice;
use App\Models\Doctor;
use App\Models\CashAccount;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\DebtAccount;
use App\Models\Individual;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class IndividualInvoices extends Component
{   
    public $invoiceSaved=false , $invoiceUpdated=false;
    public $showTable = true, $updateMode = false;
    public $patientId,$doctorId,$sectionId,$type,$serviceId,$price,$discountValue=0 ,$taxRate=0 ,$totalWithTax,$taxValue;
    public $invoiceId,$catchError;

   public function mount(){

        $this->username = auth()->user()->name;
     }
    

    public function render()
    {
        $total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discountValue) ? $this->discountValue : 0));
        $this->taxValue =  $total_after_discount * ((is_numeric($this->taxRate) ? $this->taxRate : 0) / 100);
        $this->totalWithTax = $total_after_discount + $this->taxValue;

        return view('livewire.individual_invoices.individual-invoices', [
            'single_invoices'=>Invoice::where('invoice_type',1)->get(),
            'Patients'=> Patient::all(),
            'Doctors'=> Doctor::all(),
            'Services'=> Individual::all(),
           
        ]);
    }

    public function create(){

        $this->invoiceUpdated = false;
        $this->invoiceSaved = false;
        $this->showTable = false;

    }

    public function getSection()
    {
        $doctor = Doctor::with('section')->where('id', $this->doctorId)->first();
        $this->sectionId = $doctor ->section->name;

    }

    public function getPrice()
    {
        $service = Individual::where('id', $this->serviceId)->first();
        $this->price = $service->price;
    }

    public function edit($id){
        
        $this->invoiceUpdated = false;
        $this->invoiceSaved = false;
        $this->showTable = false;
        $this->updateMode = true;
        $single_invoice = Invoice::findorfail($id);
        $this->invoiceId = $single_invoice->id;
        $this->patientId = $single_invoice->patient_id;
        $this->doctorId = $single_invoice->doctor_id;
        $this->sectionId = DB::table('section_translations')->where('id', $single_invoice->section_id)->first()->name;
        $this->serviceId = $single_invoice->individual_id;
        $this->price = $single_invoice->price;
        $this->discountValue = $single_invoice->discount_value;
        $this->taxRate = $single_invoice->tax_rate;
        $this->type = $single_invoice->type;


    }

    public function store(){

        if($this->type == 1){

            DB::beginTransaction();
            try {

                if($this->updateMode){

                    $single_invoices = Invoice::findorfail($this->invoiceId);
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patientId;
                    $single_invoices->doctor_id = $this->doctorId;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->sectionId)->first()->section_id;
                    $single_invoices->individual_id = $this->serviceId;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discountValue;
                    $single_invoices->tax_rate = $this->taxRate;
                    $single_invoices->tax_value = $this->taxValue -$this->discountValue;     
                    $single_invoices->total_with_tax =$this->totalWithTax ;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $fund_accounts = CashAccount::where('invoice_id',$this->invoiceId)->first();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $single_invoices->id;
                    $fund_accounts->patient_id = $single_invoices->patient_id;
                    $fund_accounts->amount = $single_invoices->total_with_tax;
                    $fund_accounts->save();

                    $this->reset('patientId', 'doctorId', 'sectionId','type','serviceId','price', 'discountValue','taxRate','totalWithTax','taxValue');
                    $this->invoiceUpdated =true;
                    $this->showTable =true;


                }

                else{

                    $single_invoices = new Invoice();
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patientId;
                    $single_invoices->doctor_id = $this->doctorId;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->sectionId)->first()->section_id;
                    $single_invoices->individual_id = $this->serviceId;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discountValue;
                    $single_invoices->tax_rate = $this->taxRate;
                    $single_invoices->tax_value = $this->taxValue ;     
                    $single_invoices->total_with_tax =$this->totalWithTax ;
                    $single_invoices->type = $this->type;
                    $single_invoices->invoice_status = 1;
                    $single_invoices->save();

                    $fund_accounts = new CashAccount();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $single_invoices->id;
                    $fund_accounts->patient_id = $single_invoices->patient_id;
                    $fund_accounts->amount = $single_invoices->total_with_tax;
                    $fund_accounts->save();

                    //$this->reset('patientId', 'doctorId', 'sectionId','type','serviceId','price', 'discountValue','taxRate','totalWithTax','taxValue');
                    $this->invoiceSaved =true;
                    $this->showTable =true;

                    $notifications = new Notification();
                    $notifications->user_id = $this->doctorId;
                    $patient = Patient::find($this->patientId);
                    $notifications->message = "كشف جديد : ".$patient->name;
                    $notifications->save();

                    $data=[
                        'patient_id'=>$this->patientId,
                        'invoice_id'=>$single_invoices->id,
                        'doctor_id'=>$this->doctorId,
                    ];

                    event(new CreateInvoice($data));

                }
                DB::commit();
            }

            catch (\Exception $e) {
                DB::rollback();
                $this->catchError = $e->getMessage();
            }

        }

        else{

            DB::beginTransaction();
            try {

                if($this->updateMode){

                    $single_invoices = Invoice::findorfail($this->invoiceId);
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patientId;
                    $single_invoices->doctor_id = $this->doctorId;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->sectionId)->first()->section_id;
                    $single_invoices->individual_id = $this->serviceId;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discountValue;
                    $single_invoices->tax_rate = $this->taxRate;
                    $single_invoices->tax_value = $this->taxValue ;     
                    $single_invoices->total_with_tax =$this->totalWithTax ;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();


                    $patient_accounts = DebtAccount::where('invoice_id',$this->invoiceId)->first();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->amount = $single_invoices->total_with_tax;
                    $patient_accounts->save();

                    $this->reset('patientId', 'doctorId', 'sectionId','type','serviceId','price', 'discountValue','taxRate','totalWithTax','taxValue');
                    $this->invoiceUpdated =true;
                    $this->showTable =true;

                }

                else{

                    $single_invoices = new Invoice();
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patientId;
                    $single_invoices->doctor_id = $this->doctorId;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->sectionId)->first()->section_id;
                    $single_invoices->individual_id = $this->serviceId;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discountValue;
                    $single_invoices->tax_rate = $this->taxRate;
                    $single_invoices->tax_value = $this->taxValue ;     
                    $single_invoices->total_with_tax =$this->totalWithTax ;
                    $single_invoices->type = $this->type;
                    $single_invoices->invoice_status = 1;
                    $single_invoices->save();

                    $patient_accounts = new DebtAccount();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->amount = $single_invoices->total_with_tax;
                    $patient_accounts->save();

                    $this->reset('patientId', 'doctorId', 'sectionId','type','serviceId','price', 'discountValue','taxRate','totalWithTax','taxValue');
                    $this->invoiceSaved =true;
                    $this->showTable =true;
                }

                DB::commit();
            }

            catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    public function delete($id){

     $this->invoiceId = $id;

    }

    public function destroy(){
        Invoice::destroy($this->invoiceId);
        return redirect()->route('individual_invoices');
    }

    public function print($id)
    {
        $single_invoice = Invoice::findorfail($id);
        return Redirect::route('print_individual_invoices',[
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->doctor->name,
            'section_id' => $single_invoice->section->name,
            'service_id' => $single_invoice->individual->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);

    }

}
