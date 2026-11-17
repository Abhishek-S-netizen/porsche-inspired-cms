<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class HomeController extends Controller
{
    public function showLandingPage() {
        $cars = Car::orderBy("order_index")->get();
        return view("home",compact("cars"));
    }

    public function showLoginPage() {
        return view("Admin/login");
    }
}
