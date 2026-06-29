<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;

class VariantSpec extends Model
{
    protected $fillable = [
        "variant_id",
        "key",
        "value"
    ];

    public function variant() {
        return $this->belongsTo(Variant::class);
    }
}
