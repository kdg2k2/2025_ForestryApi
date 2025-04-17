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

    public function type()
    {
        return $this->belongsTo(DocumentType::class, "id_type");
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, "id_uploader");
    }

    public function share()
    {
        return $this->belongsTo(DocumentShare::class, "id_share");
    }
}
