<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BioPlant extends Model
{
    use SoftDeletes;
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
