<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    protected $table = "documents";
    protected $guarded = [];
    protected $hidden = [
        'path',
    ];

    const validity = [
        'active' => "Có hiêu lực",
        'expired' => "Hết hiệu lực",
        'upcoming' => "Sắp hết hiệu lực",
        'undefined' => "Chưa xác định",
    ];

    public function type()
    {
        return $this->belongsTo(DocumentType::class, "id_document_type");
    }

    public function uploader()
    {
        return $this->belongsTo(Admin::class, "id_uploader");
    }

    public function share()
    {
        return $this->belongsTo(DocumentShare::class, "id_share");
    }

    public function legal()
    {
        return $this->hasOne(DocumentLegal::class, "id_document");
    }

    public function scientificPublication()
    {
        return $this->hasOne(DocumentScientificPublication::class, "id_document");
    }

    public function biodiversity()
    {
        return $this->hasOne(DocumentBiodiversity::class, "id_document");
    }


    public function orderDocument()
    {
        return $this->hasMany(OrderDocument::class, 'id_document');
    }

    public function getValidity()
    {
        return Document::validity[$this->legal->validity] ?? null;
    }

    public function images()
    {
        return $this->hasMany(DocumentImage::class, "id_document");
    }
}
