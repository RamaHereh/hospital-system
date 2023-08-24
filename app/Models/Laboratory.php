<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;
    protected $fillable =['description', 'description_emp', 'case', 
    'invoice_id', 'patient_id', 'doctor_id', 'laboratory_emp_id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function laboratoryEmp()
    {
        return $this->belongsTo(LaboratoryEmp::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
