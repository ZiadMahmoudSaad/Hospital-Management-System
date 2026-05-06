<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PatientTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name','Address'];
    public $timestamps = false;
}
