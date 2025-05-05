<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentBiodiversity extends Model
{
    use SoftDeletes;
    protected $table = "document_biodiversities";
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(DocumentBiodiversityType::class, "id_type");
    }

    public function documents()
    {
        return $this->belongsTo(Document::class, "id_document");
    }
}
