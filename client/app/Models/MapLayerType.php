<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapLayerType extends Model
{
    protected $table = "map_layer_types";
    protected $guarded = [];

    public function layers()
    {
        return $this->hasMany(MapLayer::class, 'id_layer_type');
    }
}
