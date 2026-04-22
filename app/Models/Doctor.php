<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Relations\MorphOne;

class Doctor extends Authenticatable implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'phone',
        'fees',
        'status',
        'section_id',
    ];

    public $translatedAttributes = ['name'];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function doctorappointments()
    {
        return $this->belongsToMany(Appointment::class,'appointment_doctor');
    }
}
