<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentBiodiversity extends Model
{
    protected $table = "document_biodiversities";
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(DocumentBiodiversityType::class, "id_type");
    }

    public function documents()
    {
        return $this->hasMany(Document::class, "id_document");
    }
}
