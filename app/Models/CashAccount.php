<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    use HasFactory;
    protected $fillable= ['date', 'amount', 'invoice_id', 'receipt_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function invoice()
    {
        return $this->belongsTo(invoice::class);
    }
    
    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }
    
}
