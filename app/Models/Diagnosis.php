<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Diagnosis extends Authenticatable
{
    use HasFactory;
    protected $fillable= ['date', 'review_date', 'diagnosis', 'medicine', 'invoice_id', 'patient_id', 'doctor_id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function paient()
    {
        return $this->belongsTo(Paient::class);
    }
 
}
