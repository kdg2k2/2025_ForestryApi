<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BioPlantAlbumImage extends Model
{
    protected $table = "bio_plant_album_images";
    protected $guarded = [];

    public function plant_images()
    {
        return $this->hasMany(BioPlantImage::class, 'id_img');
    }
}
