<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BioPlantNationalPark extends Model
{
    protected $table = "bio_plant_national_parks";
    protected $guarded = [];

    public function plants(){
        return $this->belongsTo(BioPlant::class, 'id_plant');
    }

    public function nationpark(){
        return $this->belongsTo(BioNationalPark::class, 'id_nationpark');
    }
}
