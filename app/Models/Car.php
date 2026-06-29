<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;

class Car extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "thumbnail_image_url",
        "thumbnail_image_public_id",
        "description",
        "order_index"
    ];

    public function variants() {
        return $this->hasMany(Variant::class);
    }
}
