<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentScientificPublicationType extends Model
{
    use SoftDeletes;
    protected $table = "document_scientific_publication_types";
    protected $guarded = [];

    public function documents()
    {
        return $this->hasMany(DocumentScientificPublication::class, 'id_type');
    }
}
