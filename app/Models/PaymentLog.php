<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $table = "payment_logs";
    protected $guarded = [];
    public $timestamps = false;

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment');
    }
}
