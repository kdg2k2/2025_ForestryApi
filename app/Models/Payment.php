<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function paymentLogs()
    {
        return $this->hasMany(PaymentLog::class, 'id_payment');
    }
}
