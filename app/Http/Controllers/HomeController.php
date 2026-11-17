<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;

class HomeController extends Controller
{
    public function showLandingPage() {
        $cars = Car::orderBy("order_index")->get();
        return view("home",compact("cars"));
    }

    public function showLoginPage() {
        if (Auth::check()) {
            return redirect("/admin/dashboard");
        }

        return view("Admin/login");
    }
}
