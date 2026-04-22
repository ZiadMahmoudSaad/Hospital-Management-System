<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Group extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

     protected $fillable = [
        'Total_before_discount',
        'discount_value',
        'Total_after_discount',
        'tax_rate',
        'Total_with_tax',
     ];
     public $translatedAttributes = ['name','notes'];

    public function service_group()
    {
        return $this->belongsToMany(Service::class,'service_group')->withPivot('quantity');
    }
}
