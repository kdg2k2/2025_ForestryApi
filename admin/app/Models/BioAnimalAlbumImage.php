<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BioAnimalAlbumImage extends Model
{
    use SoftDeletes;
    protected $table = "bio_animal_album_images";
    protected $guarded = [];

    public function animal_images()
    {
        return $this->hasMany(BioAnimalImage::class, 'id_img');
    }
}
