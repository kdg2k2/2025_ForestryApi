<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BioPlantNationalPark extends Model
{
    use SoftDeletes;
    protected $table = "bio_plant_national_parks";
    protected $guarded = [];

    public function plants()
    {
        return $this->belongsTo(BioPlant::class, 'id_plant');
    }

    public function nationpark()
    {
        return $this->belongsTo(BioNationalPark::class, 'id_nationpark');
    }
}
