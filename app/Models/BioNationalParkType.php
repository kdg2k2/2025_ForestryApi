<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BioNationalParkType extends Model
{
    protected $table = "bio_national_park_types";
    protected $guarded = [];

    public function nationpark()
    {
        return $this->hasMany(BioNationalPark::class, 'id_type');
    }
}
