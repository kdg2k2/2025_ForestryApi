<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BioAnimalNationalPark extends Model
{
    protected $table = "bio_animal_national_parks";
    protected $guarded = [];

    public function animals()
    {
        return $this->belongsTo(BioAnimal::class, 'id_animal');
    }

    public function nationpark()
    {
        return $this->belongsTo(BioAnimalNationalPark::class, 'id_nationpark');
    }
}
