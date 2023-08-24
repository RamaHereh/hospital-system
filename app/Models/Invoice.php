<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
   protected $fillable =['invoice_type', 'invoice_date', 'price', 'discount_value',
    'tax_rate', 'tax_value', 'total_with_tax', 'type','invoice_status',
    'patient_id', 'doctor_id', 'section_id', 'group_id', 'individual_id'];
   

   public function debtAccount()
   {
       return $this->hasMany(DebtAccount::class);
   }

   public function cashAccount()
   {
       return $this->hasMany(CashAccount::class);
   }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function individual()
    {
        return $this->belongsTo(Individual::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function rays()
    {
        return $this->hasMany(Ray::class);
    }
    
    public function Laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }
}
