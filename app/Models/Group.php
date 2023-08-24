<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Group extends Model
{
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['name','notes'];
    protected $fillable = ['total_before_discount','discount_value','total_after_discount','tax_rate','total_with_tax'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function services()
    {
        return $this->belongsToMany(Individual::class, 'group_individual')->withPivot('quantity');
    }
    
}
