<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ray extends Model
{
    use HasFactory;
    protected $fillable =['description', 'description_emp', 'case', 
    'invoice_id', 'patient_id', 'doctor_id', 'ray_emp_id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function rayEmp()
    {
        return $this->belongsTo(RayEmp::class);
    }
   
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
