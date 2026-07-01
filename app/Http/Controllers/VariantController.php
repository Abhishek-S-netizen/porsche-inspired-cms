<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Variant;

class VariantController extends Controller
{
    public function showVariantPage(Car $car, Variant $variant) {
        abort_unless($car->variants->contains($variant) , 404);
        $highlights = $variant->highlights;
        $engineDetails = $variant->engineDetails;

        return view("common-template",compact("car","variant","highlights","engineDetails")); 
    }
}
