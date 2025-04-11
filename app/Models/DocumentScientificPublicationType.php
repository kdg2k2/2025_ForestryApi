<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentScientificPublicationType extends Model
{
    protected $table = "document_scientific_publication_types";
    protected $guarded = [];

    public function documents()
    {
        return $this->hasMany(DocumentScientificPublication::class, 'id_type');
    }
}
