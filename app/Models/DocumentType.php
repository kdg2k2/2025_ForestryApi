<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    use SoftDeletes;
    protected $table = "document_types";
    protected $guarded = [];

    public function documents()
    {
        return $this->hasMany(Document::class, 'id_document_type');
    }
}
