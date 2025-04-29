<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentLegalType extends Model
{
    use SoftDeletes;
    protected $table = "document_legal_types";
    protected $guarded = [];

    public function documents()
    {
        return $this->hasMany(DocumentLegal::class, 'id_type');
    }
}
