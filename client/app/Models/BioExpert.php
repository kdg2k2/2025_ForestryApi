<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioExpert extends Model
{
    protected $table = "bio_experts";
    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany(BioExpertAsk::class, 'id_expert');
    }

    public function unit()
    {
        return $this->belongsTo(UserUnit::class, 'id_unit');
    }
}
