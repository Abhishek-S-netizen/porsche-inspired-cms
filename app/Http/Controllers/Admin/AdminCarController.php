<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Variant;
use App\Helpers\CloudinaryHelper;

class AdminCarController extends Controller
{
    public function addCar(Request $request) {
        $request->validate([
            "model" => "required|string|max:255",
            "description" => "nullable|string",
            "ordering_index" => "nullable|integer",
            "thumbnail_image" => "nullable|file"
        ]);

        $slug_value = Str::slug($request->model);
        $file = $request->file('thumbnail_image');

        $result = CloudinaryHelper::upload($file, "cars/thumbnails");

        Car::create([
            "slug" => $slug_value,
            "name" => $request->model,
            "description" => $request->description,
            "order_index" => $request->ordering_index,
            "thumbnail_image_url" => $result["url"],
            "thumbnail_image_public_id" => $result["public_id"]
        ]);

        return redirect()->back()->with("success","Model record created successfully");
    }

    public function editModel(Request $request) {
        $request->validate([
            "car_id" => "required|exists:cars,id",
            "model" => "required|string|max:255",
            "description" => "nullable|string",
            "ordering_index" => "nullable|string",
            "thumbnail_image" => "nullable|file"
        ]);

        $slug_value = Str::slug($request->model);
        $car = Car::findOrFail($request->car_id);

        $file = $request->file("thumbnail_image");

        if($file) {
            $result = CloudinaryHelper::upload($file,"cars/thumbnails");
            $car->update([
                "slug" => $slug_value,
                "name" => $request->model,
                "description" => $request->description,
                "order_index" => $request->ordering_index,
                "thumbnail_image_url" => $result["url"],
                "thumbnail_image_public_id" => $result["public_id"]
            ]);

            return redirect()->back()->with("success","Model record updated successfully");
        }

        $car->update([
            "slug" => $slug_value,
            "name" => $request->model,
            "description" => $request->description,
            "order_index" => $request->ordering_index
        ]);

         return redirect()->back()->with("success","Model record updated successfully");
    }

    public function deleteModel(Request $request) {
        $request->validate([
            "car_id" => "required|exists:cars,id"
        ]);

        $car = Car::findOrFail($request->car_id);
        
        $imagesId = ["parallax_image_public_id","side_profile_public_id","front_profile_public_id","drive_parallax_public_id","gallery_1_public_id","gallery_2_public_id","gallery_3_public_id"];

        foreach($car->variants as $variant) {
            foreach($imagesId as $image) {
                CloudinaryHelper::delete($variant->$image);
            }

            foreach($variant->highlights as $highlight) {
                CloudinaryHelper::delete($highlight->highlight_image_public_id);
            }

            foreach($variant->engineDetails as $engineDetail) {
                CloudinaryHelper::delete($engineDetail->engine_image_public_id);
            }
        }

        CloudinaryHelper::delete($car->thumbnail_image_public_id);
        $car->delete();
        return redirect()->back()->with("success","Model record deleted successfully");
    }
}
