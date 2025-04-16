<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BioNationalParkType extends Model
{
    use SoftDeletes;
    protected $table = "bio_national_park_types";
    protected $guarded = [];

    public function nationpark()
    {
        return $this->hasMany(BioNationalPark::class, 'id_type');
    }
}
