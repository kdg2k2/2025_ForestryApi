<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BioPlantAlbumImage extends Model
{
    use SoftDeletes;
    protected $table = "bio_plant_album_images";
    protected $guarded = [];

    public function plant_images()
    {
        return $this->hasMany(BioPlantImage::class, 'id_img');
    }
}
