<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = "document_types";
    protected $guarded = [];

    public function documents()
    {
        return $this->hasMany(Document::class, 'id_document_type');
    }
}
