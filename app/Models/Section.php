<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable; 
    public $translatedAttributes = ['name'];
    
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}


