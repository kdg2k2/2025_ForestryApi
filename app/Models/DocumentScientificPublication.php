<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentScientificPublication extends Model
{
    protected $table = "document_scientific_publications";
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(DocumentScientificPublicationType::class, "id_type");
    }

    public function document()
    {
        return $this->belongsTo(Document::class, "id_document");
    }
}
