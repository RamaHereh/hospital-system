<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtAccount extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'amount', 'patient_id', 'invoice_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function invoice()
    {
        return $this->belongsTo(invoice::class);
    }

}
