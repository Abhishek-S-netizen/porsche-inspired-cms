<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
use App\Models\VariantSpec;
use App\Models\Section;
use App\Models\Highlight;
use App\Models\EngineDetail;

class Variant extends Model
{
    protected $fillable = [
        "car_id",
        "variant",
        "slug",
        "year",
        "fuel_type",
        "gearbox",
        "title",
        "title_content",
        "drive_content",
        "order_index",
        "gallery_content",
        "parallax_image_url",
        "parallax_image_public_id",
        "side_profile_url",
        "side_profile_public_id",
        "front_profile_url",
        "front_profile_public_id",
        "drive_parallax_url",
        "drive_parallax_public_id",
        "gallery_1_url",
        "gallery_1_public_id",
        "gallery_2_url",
        "gallery_2_public_id",
        "gallery_3_url",
        "gallery_3_public_id"
    ];        

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function specs() {
        return $this->hasMany(VariantSpec::class);
    }

     public function highlights() {
        return $this->hasMany(Highlight::class);
     }

     public function engineDetails() {
        return $this->hasMany(EngineDetail::class);
     }
}
