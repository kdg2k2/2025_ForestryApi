<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentImage extends Model
{
    protected $table = "document_images";
    protected $guarded = [];
    public function document()
    {
        return $this->belongsTo(Document::class, "id_document");
    }
}
