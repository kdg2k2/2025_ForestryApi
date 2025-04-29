<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioExpertAskImage extends Model
{
    protected $table = "bio_expert_ask_images";
    protected $guarded = [];

    public function ask()
    {
        return $this->belongsTo(BioExpertAsk::class, 'id_ask');
    }
}
