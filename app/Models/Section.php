<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Doctor;
class Section extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['name'];
    public $translatedAttributes = ['name','description'];


    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
