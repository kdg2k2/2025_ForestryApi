<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentViewLog extends Model
{
    protected $table = "document_view_logs";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, "id_user");
    }

    public function document()
    {
        return $this->belongsTo(Document::class, "id_document");
    }
}
