<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BioAnimalAlbumImage extends Model
{
    protected $table = "bio_animal_album_images";
    protected $guarded = [];

    public function animal_images()
    {
        return $this->hasMany(BioAnimalImage::class, 'id_img');
    }
}
