<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor  extends Authenticatable
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name'];
    protected $fillable= ['email','email_verified_at','password','phone','section_id','status'];
  
    
    public function doctorappointments()
    {
        return $this->belongsToMany(Appointment::class,'appointment_doctor');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
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
