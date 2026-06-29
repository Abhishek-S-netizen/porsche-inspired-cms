<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;

class EngineDetail extends Model
{
    protected $fillable = [
        "variant_id",
        "title",
        "description",
        "position",
        "engine_image_url",
        "engine_image_public_id"
    ];

    public function variant() {
        return $this->belongsTo(Variant::class);
    }
}
