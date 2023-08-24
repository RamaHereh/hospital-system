<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Individual extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name'];
    public $fillable= ['price','description','status'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_individual')->withPivot('quantity');
    }
}
