<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentBiodiversityType extends Model
{
    use SoftDeletes;
    protected $table = "document_biodiversity_types";
    protected $guarded = [];

    public function documents()
    {
        return $this->hasMany(DocumentBiodiversity::class, "id_type");
    }
}
