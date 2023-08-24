<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable =['date', 'amount', 'description', 'patient_id'];

    public function cashAccount()
    {
        return $this->hasMany(CashAccount::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
