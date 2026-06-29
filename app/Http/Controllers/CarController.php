<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Variant;

class CarController extends Controller
{
    public function showModels(Car $car) {
        $carVariants = $car->variants()->get();
        return view("variants-page",compact("car","carVariants"));
    }
}
