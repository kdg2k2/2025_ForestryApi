<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BioNationalPark extends Model
{
    use SoftDeletes;
    protected $table = "bio_national_parks";
    protected $guarded = [];

    public function animal_nationpark()
    {
        return $this->hasMany(BioAnimalNationalPark::class, 'id_nationpark');
    }

    public function plant_nationpark()
    {
        return $this->hasMany(BioPlantNationalPark::class, 'id_nationpark');
    }

    public function type_nationpark()
    {
        return $this->belongsTo(BioNationalParkType::class, 'id_type');
    }
}
