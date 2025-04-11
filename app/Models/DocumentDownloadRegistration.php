<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentDownloadRegistration extends Model
{
    protected $table = "document_download_registrations";
    protected $guarded = [];

    const status = ['pending', 'approve', 'deny'];

    public function getStatus($key = null)
    {
        if ($key)
            return self::status[$key] ?? null;
        return self::status;
    }

    public function subscriber()
    {
        return $this->belongsTo(User::class, "id_subscriber");
    }

    public function document()
    {
        return $this->belongsTo(Document::class, "id_document");
    }

    public function approver()
    {
        return $this->belongsTo(User::class, "id_approver");
    }
}
