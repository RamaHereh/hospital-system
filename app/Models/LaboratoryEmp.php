<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LaboratoryEmp  extends Authenticatable
{
    use HasFactory;
    protected $fillable=['name', 'email', 'password'];
    
    public function Laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }
}
