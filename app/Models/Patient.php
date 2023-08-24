<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name','address'];
    public $fillable= ['email','password','date_Birth','phone','gender','blood_Group'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function rays()
    {
        return $this->hasMany(Ray::class);
    }

    public function debtAccounts()
    {
        return $this->hasMany(DebtAccount::class);
    }

    public function cashAccounts()
    {
        return $this->hasMany(CashAccount::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
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
