<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;
    protected $fillable = [
        'price',
        'description',
        'status',
    ];

    public $translatedAttributes = ['name'];
}
