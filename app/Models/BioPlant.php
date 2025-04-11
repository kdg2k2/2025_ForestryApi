<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BioPlant extends Model
{
    protected $table = "bio_plants";
    protected $guarded = [];

    public function plant_images()
    {
        return $this->hasMany(BioPlantImage::class, 'id_plant');
    }

    public function plant_nationpark()
    {
        return $this->belongsTo(BioPlantNationalPark::class, 'id_plant');
    }
}
