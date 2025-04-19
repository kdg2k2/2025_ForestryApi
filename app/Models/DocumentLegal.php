<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentLegal extends Model
{
    use SoftDeletes;
    protected $table = "document_legals";
    protected $guarded = [];

    const validity = [
        'active' => "Còn hiệu lực",
        'expired' => "Hết hiệu lực",
        'upcoming' => "Sắp có hiệu lực",
        'undefined' => "Không xác định",
    ];

    public function getValidity($key = null)
    {
        if ($key)
            return self::validity[$key] ?? null;
        return self::validity;
    }

    public function type()
    {
        return $this->belongsTo(DocumentLegalType::class, "id_type");
    }

    public function documents()
    {
        return $this->belongsTo(Document::class, "id_document");
    }
}
