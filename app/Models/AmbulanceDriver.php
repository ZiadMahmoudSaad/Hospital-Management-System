<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class AmbulanceDriver extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name'];
    public $fillable= ['driver_license_number','driver_phone','ambulance_id'];


        public function ambulance(): BelongsTo
    {
        return $this->belongsTo(Ambulance::class);
    }

}
