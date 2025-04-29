<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BioAnimalImage extends Model
{
    use SoftDeletes;
    protected $table = "bio_animal_images";
    protected $guarded = [];

    public function animals()
    {
        return $this->hasMany(BioAnimal::class, 'id_animal');
    }

    public function bio_animal_images()
    {
        return $this->belongsTo(BioAnimalAlbumImage::class, 'id_img');
    }
}
