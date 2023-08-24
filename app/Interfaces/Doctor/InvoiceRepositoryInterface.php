<?php

namespace App\Interfaces\Doctor;

interface InvoiceRepositoryInterface
{
    public function inProcessInvoices();

    public function reviewedInvoices();

    public function completedInvoices();

    public function patientDetails($id);

}
