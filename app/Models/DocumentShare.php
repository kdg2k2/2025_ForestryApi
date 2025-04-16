<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentShare extends Model
{
    use SoftDeletes;
    protected $table = "document_shares";
    protected $guarded = [];

    public function approver()
    {
        return $this->belongsTo(User::class, "id_approver");
    }

    public function unit()
    {
        return $this->belongsTo(UserUnit::class, "id_unit");
    }
}
