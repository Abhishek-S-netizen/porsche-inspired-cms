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

    public function showDemoModelsPage() {
        return view("models-page");
    }

    public function show911VariantPage() {
        return view("911/911_template");
    }

    public function showAdminDashboard() {
        return view("Admin/admin-dashboard-official");
    }

    public function showLoginPage() {
        return view("Admin/login");
    }
}
