<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BioPlantImage extends Model
{
    protected $table = "bio_plant_images";
    protected $guarded = [];

    public function plants()
    {
        return $this->hasMany(BioPlant::class, 'id_plant');
    }

    public function bio_plant_images()
    {
        return $this->belongsTo(BioPlantAlbumImage::class, 'id_img');
    }
}
