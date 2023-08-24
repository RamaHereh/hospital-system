<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\CashAccount;
use App\Models\Group;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\DebtAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class GroupInvoices extends Component
{
    public $invoiceSaved=false , $invoiceUpdated=false ;
    public $showTable = true, $updateMode = false;
    public $patientId,$doctorId,$sectionId,$type,$groupId,$price,$discountValue ,$taxRate ,$totalWithTax,$taxValue;
    public $invoiceId, $catchError;



    public function render()
    {
   
        return view('livewire.group_invoices.group-invoices', [
            'group_invoices'=>Invoice::where('invoice_type',2)->get(),
            'patients'=>Patient::all(),
            'doctors'=>Doctor::all(),
            'groups'=>Group::all(),
    
        ]);
    }

    public function create(){
        $this->invoiceSaved = false;
        $this->invoiceUpdated = false;
        $this->showTable = false;

    }

    public function getSection()
    {
        $doctor = Doctor::with('section')->where('id', $this->doctorId)->first();
        $this->sectionId = $doctor->section->name;
    }

    public function getPrice()
    {
        $group = Group::where('id', $this->groupId)->first();
        $this->price = $group->total_before_discount;
        $this->discountValue = $group->discount_value;
        $this->taxRate = $group->tax_rate;
        $this->taxValue = $group->total_after_discount * $this->taxRate /100 ;
        $this->totalWithTax = $group->total_with_tax;
    }


    public function store()
    {

        if($this->type == 1){

            try {
              
                if($this->updateMode){

                    $group_invoices = Invoice::findorfail($this->invoiceId);
                    $group_invoices->invoice_type = 2;
                    $group_invoices->invoice_date = date('Y-m-d');
                    $group_invoices->patient_id = $this->patientId;
                    $group_invoices->doctor_id = $this->doctorId;
                    $group_invoices->section_id = DB::table('section_translations')->where('name', $this->sectionId)->first()->section_id;
                    $group_invoices->group_id = $this->groupId;
                    $group_invoices->price = $this->price;
                    $group_invoices->discount_value = $this->discountValue;
                    $group_invoices->tax_rate = $this->taxRate;
                    $group_invoices->tax_value = $this->taxValue;
                    $group_invoices->total_with_tax = $this->totalWithTax ;
                    $group_invoices->type = $this->type;
                    $group_invoices->save();

                    $fund_accounts = CashAccount::where('invoice_id',$this->invoiceId)->first();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $group_invoices->id;
                    $fund_accounts->amount = $group_invoices->total_with_tax;
                    $fund_accounts->save();

                    $this->updateMode = false;
                    $this->invoiceUpdated =true;
                    $this->showTable =true;
                    $this->reset('patientId', 'doctorId', 'sectionId','type','groupId','price','discountValue' ,'taxRate','totalWithTax','taxValue');

                }

                else{

                    $group_invoices = new Invoice();
                    $group_invoices->invoice_type = 2;
                    $group_invoices->invoice_date = date('Y-m-d');
                    $group_invoices->patient_id = $this->patientId;
                    $group_invoices->doctor_id = $this->doctorId;
                    $group_invoices->section_id = DB::table('section_translations')->where('name', $this->sectionId)->first()->section_id;
                    $group_invoices->group_id = $this->groupId;
                    $group_invoices->price = $this->price;
                    $group_invoices->discount_value = $this->discountValue;
                    $group_invoices->tax_rate = $this->taxRate;
                    $group_invoices->tax_value = $this->taxValue;
                    $group_invoices->total_with_tax = $this->totalWithTax ;
                    $group_invoices->type = $this->type;
                    $group_invoices->save();

                    $fund_accounts = new CashAccount();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $group_invoices->id;
                    $fund_accounts->amount = $group_invoices->total_with_tax;
                    $fund_accounts->save();

                    $this->invoiceSaved =true;
                    $this->showTable =true;
                    $this->reset('patientId', 'doctorId', 'sectionId','type','groupId','price','discountValue' ,'taxRate','totalWithTax','taxValue');
                }

            }


            catch (\Exception $e) {
                $this->catchError = $e->getMessage();
            }

        }

        else{

            try {
                
                if($this->updateMode){

                    $group_invoices = Invoice::findorfail($this->invoiceId);
                    $group_invoices->invoice_type = 2;
                    $group_invoices->invoice_date = date('Y-m-d');
                    $group_invoices->patient_id = $this->patientId;
                    $group_invoices->doctor_id = $this->doctorId;
                    $group_invoices->section_id = DB::table('section_translations')->where('name', $this->sectionId)->first()->section_id;
                    $group_invoices->group_id = $this->groupId;
                    $group_invoices->price = $this->price;
                    $group_invoices->discount_value = $this->discountValue;
                    $group_invoices->tax_rate = $this->taxRate;
                    $group_invoices->tax_value = $this->taxValue;
                    $group_invoices->total_with_tax = $this->totalWithTax ;
                    $group_invoices->type = $this->type;
                    $group_invoices->save();

                    $patient_accounts = DebtAccount::where('invoice_id',$this->invoiceId)->first();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->invoice_id = $group_invoices->id;
                    $patient_accounts->patient_id = $group_invoices->patient_id;
                    $patient_accounts->amount = $group_invoices->total_with_tax;
                    $patient_accounts->save();

                    $this->updateMode = false;
                    $this->invoiceUpdated =true;
                    $this->showTable =true;
                    $this->reset('patientId', 'doctorId', 'sectionId','type','groupId','price','discountValue' ,'taxRate','totalWithTax','taxValue');

                }

                else{

                    $group_invoices = new Invoice();
                    $group_invoices->invoice_type = 2;
                    $group_invoices->invoice_date = date('Y-m-d');
                    $group_invoices->patient_id = $this->patientId;
                    $group_invoices->doctor_id = $this->doctorId;
                    $group_invoices->section_id = DB::table('section_translations')->where('name', $this->sectionId)->first()->section_id;
                    $group_invoices->group_id = $this->groupId;
                    $group_invoices->price = $this->price;
                    $group_invoices->discount_value = $this->discountValue;
                    $group_invoices->tax_rate = $this->taxRate;
                    $group_invoices->tax_value = $this->taxValue;
                    $group_invoices->total_with_tax = $this->totalWithTax ;
                    $group_invoices->type = $this->type;
                    $group_invoices->save();

                    $patient_accounts = new DebtAccount();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->invoice_id = $group_invoices->id;
                    $patient_accounts->patient_id = $group_invoices->patient_id;
                    $patient_accounts->amount = $group_invoices->total_with_tax;
                    $patient_accounts->save();

                    $this->invoiceSaved =true;
                    $this->showTable =true;
                    $this->reset('patientId', 'doctorId', 'sectionId','type','groupId','price','discountValue' ,'taxRate','totalWithTax','taxValue');
                }

            }

            catch (\Exception $e) {
                $this->catchError = $e->getMessage();
            }
        }
    }


    public function edit($id){
        $this->invoiceSaved = false;
        $this->invoiceUpdated = false;
        $this->showTable = false;
        $this->updateMode = true;
        $group_invoices = Invoice::findorfail($id);
        $this->invoiceId = $group_invoices->id;
        $this->patientId = $group_invoices->patient_id;
        $this->doctorId = $group_invoices->doctor_id;
        $this->sectionId = DB::table('section_translations')->where('id', $group_invoices->section_id)->first()->name;
        $this->groupId = $group_invoices->group_id;
        $this->price = $group_invoices->price;
        $this->discountValue = $group_invoices->discount_value;
        $this->taxRate = $group_invoices->tax_rate;
        $this->taxValue = $group_invoices->tax_value;
        $this->totalWithTax = $group_invoices->total_with_tax;
        $this->type = $group_invoices->type;

    }

    public function delete($id){
        $this->invoiceId = $id;
    }

    public function destroy(){
        Invoice::destroy($this->invoiceId);
        return redirect()->route('group_invoices');
    }

    public function print($id)
    {
        $single_invoice = Invoice::findorfail($id);
        return Redirect::route('print_group_invoices',[
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->doctor->name,
            'section_id' => $single_invoice->section->name,
            'group_id' => $single_invoice->group->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discountValue,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);

    }
}
