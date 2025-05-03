<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUserRole extends Model
{
    protected $table = "order_user_roles";
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, "id_order");
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, "id_role");
    }
}
