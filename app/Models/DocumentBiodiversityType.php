<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentBiodiversityType extends Model
{
    protected $table = "document_biodiversity_types";
    protected $guarded = [];

    public function documents()
    {
        return $this->hasMany(DocumentBiodiversity::class, "id_type");
    }
}
