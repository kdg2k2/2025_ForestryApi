<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapLayer extends Model
{
    protected $table = "map_layers";
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(MapLayerType::class, 'id_layer_type');
    }
}
