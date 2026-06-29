<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;

class Highlight extends Model
{
    protected $fillable = [
        "variant_id",
        "title",
        "description",
        "highlight_image_url",
        "highlight_image_public_id",
        "position"
    ];

    public function variant() {
        return $this->belongsTo(Variant::class);
    }
}
