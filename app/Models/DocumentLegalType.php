<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentLegalType extends Model
{
    protected $table = "document_legal_types";
    protected $guarded = [];

    public function documents()
    {
        return $this->hasMany(DocumentLegal::class, 'id_type');
    }
}
