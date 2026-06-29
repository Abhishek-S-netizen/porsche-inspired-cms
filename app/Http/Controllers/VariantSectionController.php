<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variant;

class VariantSectionController extends Controller
{

    public function addSectionForCar(Request $request) {
        $request->validate = ([
            "variant_id" => "required|exists:variants,id",
            "section_ids" => "required|array",
            "section_ids.*" => "required|exists:variants,id"
        ]);
    }

    public function editSection() {}

    public function deleteSectionForCar() {}
}
