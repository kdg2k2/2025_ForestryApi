<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BioAnimal extends Model
{
    protected $table = "bio_animals";
    protected $guarded = [];

    public function animal_images()
    {
        return $this->hasMany(BioAnimalImage::class, 'id_animal');
    }

    public function animal_nationpark()
    {
        return $this->belongsTo(BioAnimalNationalPark::class, 'id_animal');
    }
}
