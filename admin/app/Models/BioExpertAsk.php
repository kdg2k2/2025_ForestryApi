<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioExpertAsk extends Model
{
    protected $table = "bio_expert_asks";
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(BioExpertAskImage::class, 'id_ask');
    }

    public function expert()
    {
        return $this->belongsTo(BioExpert::class, 'id_expert');
    }

    public function unit()
    {
        return $this->belongsTo(UserUnit::class, 'id_unit');
    }
}
