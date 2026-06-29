<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Variant;
use App\Models\Highlight;
use App\Models\EngineDetail;
use App\Helpers\CloudinaryHelper;

class AdminVariantController extends Controller
{
    public function addVariant(Request $request) {
        $request->validate([
            "car_id" => "required|exists:cars,id",
            "variant" => "required|string|max:255",
            "year" => "nullable|digits:4|integer",
            "gearbox" => "nullable|string|max:1000",
            "fuel_type" => "nullable|string|max:255",
            "title" => "required|string|max:255",
            "title_content" => "required|string|max:2000",
            "drive_content" => "required|string|max:2000",
            "gallery_content" => "required|string|max:2000",
            "ordering_index" => "required|integer",
            "parallax_image" => "required|file",
            "front_profile" => "required|file",
            "side_profile" => "required|file",
            "drive_parallax_image" => "required|file",
            "gallery_image_1" => "required|file",
            "gallery_image_2" => "required|file",
            "gallery_image_3" => "required|file"
        ]);

        $slug_value = Str::slug($request->variant);
        $fileParallax = $request->parallax_image;
        $fileFrontProfile = $request->front_profile;
        $fileSideProfile = $request->side_profile;
        $fileDriveParallax = $request->drive_parallax_image;
        $fileGalleryImage1 = $request->gallery_image_1;
        $fileGalleryImage2 = $request->gallery_image_2;
        $fileGalleryImage3 = $request->gallery_image_3;

        $resultParallax = CloudinaryHelper::upload($fileParallax, "cars/parallax");
        
        $resultFrontProfile = CloudinaryHelper::upload($fileFrontProfile, "cars/car_front_profiles");
        
        $resultSideProfile = CloudinaryHelper::upload($fileSideProfile, "cars/car_side_profiles");

        $resultDriveParallax = CloudinaryHelper::upload($fileDriveParallax, "cars/drive_parallax");

        $resultGallery1 = CloudinaryHelper::upload($fileGalleryImage1,"cars/gallery_image_1");

        $resultGallery2 = CloudinaryHelper::upload($fileGalleryImage2, "cars/gallery_image_2");

        $resultGallery3 = CloudinaryHelper::upload($fileGalleryImage3, "cars/gallery_image_3");

        Variant::create([
            "slug" => $slug_value,
            "car_id" => $request->car_id,
            "variant" => $request->variant,
            "year" => $request->year,
            "gearbox" => $request->gearbox,
            "fuel_type" => $request->fuel_type,
            "title" => $request->title,
            "title_content" => $request->title_content,
            "drive_content" => $request->drive_content,
            "gallery_content" => $request->gallery_content,
            "order_index" => $request->ordering_index,
            "parallax_image_url" => $resultParallax["url"],
            "parallax_image_public_id" => $resultParallax["public_id"],
            "side_profile_url" => $resultSideProfile["url"],
            "side_profile_public_id" => $resultSideProfile["public_id"],
            "front_profile_url" => $resultFrontProfile["url"],
            "front_profile_public_id" => $resultFrontProfile["public_id"],
            "drive_parallax_url" => $resultDriveParallax["url"],
            "drive_parallax_public_id" => $resultDriveParallax["public_id"],
            "gallery_1_url" => $resultGallery1["url"],
            "gallery_1_public_id" => $resultGallery1["public_id"],
            "gallery_2_url" => $resultGallery2["url"],
            "gallery_2_public_id" => $resultGallery2["public_id"],
            "gallery_3_url" => $resultGallery3["url"],
            "gallery_3_public_id" => $resultGallery3["public_id"]
        ]);

        return redirect()->back()->with("success","Variant record added successfully");
    }

    public function editVariant(Request $request) {
        $request->validate([
            "car_id" => "required|exists:cars,id",
            "variant_id" => "required|exists:variants,id",
            "variant" => "required|string|max:255",
            "year" => "nullable|digits:4|integer",
            "gearbox" => "nullable|string|max:1000",
            "fuel_type" => "nullable|string|max:255",
            "title" => "required|string|max:255",
            "title_content" => "required|string|max:2000",
            "drive_content" => "required|string|max:2000",
            "gallery_content" => "required|string|max:2000",
            "ordering_index" => "required|integer",
            "parallax_image" => "nullable|file",
            "front_profile" => "nullable|file",
            "side_profile" => "nullable|file",
            "drive_parallax_image" => "nullable|file",
            "gallery_image_1" => "nullable|file",
            "gallery_image_2" => "nullable|file",
            "gallery_image_3" => "nullable|file"
        ]);

        $variant = Variant::findOrFail($request->variant_id);
        $slug = Str::slug($request->variant);

        $variant->update([
            "slug" => $slug,
            "variant" => $request->variant,
            "year" => $request->year,
            "gearbox" => $request->gearbox,
            "fuel_type" => $request->fuel_type,
            "title" => $request->title,
            "title_content" => $request->title_content,
            "drive_content" => $request->drive_content,
            "gallery_content" => $request->gallery_content,
            "order_index" => $request->ordering_index
        ]);

        $imageMappings = [
            "parallax_image" => [
                "folder" => "cars/parallax",
                "url" => "parallax_image_url",
                "public_id" => "parallax_image_public_id"
            ],

            "front_profile" => [
                "folder" => "cars/car_front_profiles",
                "url" => "front_profile_url",
                "public_id" => "front_profile_public_id"
            ],

            "side_profile" => [
                "folder" => "cars/car_side_profiles",
                "url" => "side_profile_url",
                "public_id" => "side_profile_public_id"
            ],

            "drive_parallax_image" => [
                "folder" => "cars/drive_parallax",
                "url" => "drive_parallax_url",
                "public_id" => "drive_parallax_public_id"
            ],

            "gallery_image_1" => [
                "folder" => "cars/gallery_image_1",
                "url" => "gallery_1_url",
                "public_id" => "gallery_1_public_id"
            ],

            "gallery_image_2" => [
                "folder" => "cars/gallery_image_2",
                "url" => "gallery_2_url",
                "public_id" => "gallery_2_public_id"
            ],

            "gallery_image_3" => [
                "folder" => "cars/gallery_image_3",
                "url" => "gallery_3_url",
                "public_id" => "gallery_3_public_id"
            ]
        ];

        foreach ($imageMappings as $input => $config) {
            if ($request->hasFile($input)) {
                $upload = CloudinaryHelper::upload($request->file($input), $config["folder"]);

                $variant->update([
                    $config["url"] => $upload["url"],
                    $config["public_id"] => $upload["public_id"] 
                ]);
            }
        }

        return redirect()->back()->with("success","Variant details updated successfully");
    }

    public function deleteVariant(Request $request) {
        $request->validate([
            "car_id" => "required|exists:cars,id",
            "variant_id" => "required|exists:variants,id"
        ]);

        $variant = Variant::findOrFail($request->variant_id);

        $imagesId = ["parallax_image_public_id","side_profile_public_id","front_profile_public_id","drive_parallax_public_id","gallery_1_public_id","gallery_2_public_id","gallery_3_public_id"];

        foreach($imagesId as $image) {
            CloudinaryHelper::delete($variant->$image);
        }

        foreach($variant->highlights as $highlight) {
            CloudinaryHelper::delete($highlight->highlight_image_public_id);
        }

        foreach($variant->engineDetails as $engineDetail) {
            CloudinaryHelper::delete($engineDetail->engine_image_public_id);
        }

        $variant->delete();
        return redirect()->back()->with("success","Variant record deleted successfully");
    }

    public function addHighlights(Request $request) {
        $request->validate([
            "variant_id" => "required|exists:variants,id",
            "title" => "required|string|max:1000",
            "description" => "required|string|max:20000",
            "position" => "nullable|integer",
            "highlight_image" => "nullable|file"
        ]);

        $highlightVariant = Highlight::create([
            "variant_id" => $request->variant_id,
            "title" => $request->title,
            "description" => $request->description,
            "position" => $request->position
        ]);

        if ($request->hasFile("highlight_image")) {
            $highlightImage = $request->file("highlight_image");
            $file = CloudinaryHelper::upload($highlightImage,"cars/variants/highlightImages");

            $highlightVariant->update([
                "highlight_image_url" => $file["url"],
                "highlight_image_public_id" => $file["public_id"]
            ]);
        }

        return redirect()->back()->with("success","Highlight added successfully");
    }

    public function editHighlights(Request $request) {
        $request->validate([
            "variant_id" => "required|exists:variants,id",
            "highlight_id" => "required|exists:highlights,id",
            "title" => "required|string|max:1000",
            "description" => "required|string|max:20000",
            "position" => "nullable|integer",
            "highlight_image" => "nullable|file"
        ]);

        $highlight = Highlight::findOrFail($request->highlight_id);

        $highlight->update([
            "title" => $request->title,
            "description" => $request->description,
            "position" => $request->position
        ]);

        if ($request->hasFile("highlight_image")) {
            CloudinaryHelper::delete($highlight->highlight_image_public_id);
            $file = CloudinaryHelper::upload($request->file("highlight_image"),"cars/variants/highlightImages");

            $highlight->update([
                "highlight_image_url" => $file["url"],
                "highlight_image_public_id" => $file["public_id"]
            ]);
        }

        return redirect()->back()->with("success","Highlight edited successfully");
    }

    public function deleteHighlights(Request $request) {
        $request->validate([
            "variant_id" => "required|exists:variants,id",
            "highlight_id" => "required|exists:highlights,id"
        ]);

        $highlight = Highlight::findOrFail($request->highlight_id);
        CloudinaryHelper::delete($highlight->highlight_image_public_id);
        $highlight->delete();

        return redirect()->back()->with("success","Highlight deleted successfully");
    }

    public function addEngineDetails(Request $request) {
        $request->validate([
            "variant_id" => "required|exists:variants,id",
            "title" => "required|string|max:500",
            "description" => "required|string|max:10000",
            "position" => "required|integer",
            "engine_image" => "nullable|file"
        ]);

        $engineDetail = EngineDetail::create([
            "variant_id" => $request->variant_id,
            "title" => $request->title,
            "description" => $request->description,
            "position" => $request->position,
        ]);

        if($request->hasFile("engine_image")) {
            $file = $request->file("engine_image");
            $image = CloudinaryHelper::upload($file,"cars/variants/engineDetailImages");

            $engineDetail->update([
                "engine_image_url" => $image["url"],
                "engine_image_public_id" => $image['public_id']
            ]);
        }

        return redirect()->back()->with("success","Engine Detail added successfully");
    }

    public function editEngineDetails(Request $request) {
        $request->validate([
            "engine_detail_id" => "required|exists:engine_details,id",
            "variant_id" => "required|exists:variants,id",
            "title" => "required|string|max:500",
            "description" => "required|string|max:10000",
            "position" => "required|integer",
            "engine_image" => "nullable|file"
        ]);

        $engineDetail = EngineDetail::findOrFail($request->engine_detail_id);

        $engineDetail->update([
            "title" => $request->title,
            "description" => $request->description,
            "position" => $request->position
        ]);

        if($request->hasFile("engine_image")) {
            $file = $request->file("engine_image");
            CloudinaryHelper::delete($engineDetail->engine_image_public_id);
            $image = CloudinaryHelper::upload($file,"cars/variants/engineDetailImages");

            $engineDetail->update([
                "engine_image_url" => $image["url"],
                "engine_image_public_id" => $image["public_id"]
            ]);
        }

        return redirect()->back()->with("success","Engine Detail edited successfully");
    }

    public function deleteEngineDetails(Request $request) {
        $request->validate([
            "engine_detail_id" => "required|exists:engine_details,id",
            "variant_id" => "required|exists:variants,id"
        ]);

        $engineDetail = EngineDetail::findOrFail($request->engine_detail_id);

        CloudinaryHelper::delete($engineDetail->engine_image_public_id);
        $engineDetail->delete();

        return redirect()->back()->with("success","Engine Detail deleted successfully");
    }
}
