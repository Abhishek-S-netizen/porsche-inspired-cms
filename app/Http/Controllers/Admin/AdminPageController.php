<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Car;
use App\Models\Variant;

class AdminPageController extends Controller
{
    public function verifyAdmin(Request $request) {
        $credentials = $request->validate([
            "email" => "required|email|exists:users,email",
            "password" => "required"
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended("/admin/dashboard");
        }
        
        return back()->withErrors([
            "login" => "Invalid credentials"
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }

    /************************************************************************************ */

    public function addAdmin(Request $request) {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8|confirmed",
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return redirect()->back()->with("success","User added successfully");
    }
    
    /*************************************************************************************/

    public function editPassword(Request $request) {
        $request->validate([
            "current_password" => "required|string|min:8", 
            "password" => "required|string|min:8|confirmed"
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                "password" => Hash::make($request->password)
            ]);
            return redirect()->back()->with("success","Password updated successfully");
        }

        return back()->withErrors([
            "current_password" => "Current passwords do not match"
        ]);
    }

    /*****************************************************************************************/

    public function showAdminDashboard() {
        $cars = Car::get();
        $variants = Variant::get();
        return view("Admin/admin-dashboard-official",compact("cars","variants"));
    }

    /****************************************************************************************/

    public function showAddUserPage() {
        return view("Admin/add-user");
    }

    /***************************************************************************************/

    public function showUpdatePasswordPage() {
        $user = Auth::user();
        return view("Admin/update-password",compact("user"));
    }

    /***************************************************************************************/
    
    public function showEditModelPage(Car $car) {
        return view("Admin/admin-edit-model",compact("car"));
    }

    /*************************************************************************************/    
    
    public function showEditVariantPage(Car $car, Variant $variant) {
        abort_unless(
            $car->variants()->where("id", $variant->id)->exists(), 404
        );
        
        return view("Admin/admin-edit-variant",compact("car","variant"));
    }

    /*************************************************************************************/    
    
    public function showHighlightsPage(Car $car, Variant $variant) {
        abort_unless(
            $car->variants()->where("id",$variant->id)->exists(), 404
        );

        $highlights = $variant->highlights()->get();

        return view("Admin/admin-add-highlights",compact("car","variant","highlights"));
    }

    /*************************************************************************************/    
    
    public function showEngineDetailsPage(Car $car, Variant $variant) {
        abort_unless(
            $car->variants()->where("id",$variant->id)->exists(), 404
        );

        $engineDetails = $variant->engineDetails()->get();

        return view("Admin/admin-add-engine-details",compact("car","variant","engineDetails"));
    }
}
