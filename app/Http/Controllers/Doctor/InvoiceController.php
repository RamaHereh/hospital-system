<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctor\InvoiceRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $invoice;

    public function __construct(InvoiceRepositoryInterface $invoice)
    {
        $this->invoice = $invoice;
    }

    public function inProcessInvoices()
    {
       return $this->invoice->inProcessInvoices();
    }

    public function reviewedInvoices()
    {
        return $this->invoice->reviewedInvoices();
    }

    public function completedInvoices()
    {
        return $this->invoice->completedInvoices();
    }

    public function patientDetails($id){

        return $this->invoice->patientDetails($id);
    }

}
