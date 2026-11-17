<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VariantSpec;

class AdminSpecsController extends Controller
{
    public const SPEC_FIELDS = [
        "power_kw" => "Power in kW",
        "power_ps" => "Power in PS",
        "torque_nm" => "Torque in NM",
        "cylinders" => "Number of cylinders",
        "stroke" => "Stroke",
        "displacement" => "Displacement",
        "maximum_engine_speed" => "Maximum engine speed",
        "top_speed" => "Top Speed",
        "acceleration_0_100" => "Acceleration (0-100kph)",
        "accleration_0_160" => "Acceleration (0-160kph)",
        "acceleration_0_200" => "Acceleration (0-200kph)",
        "electric_range_combined" => "Electric range combined",
        "gross_battery_energy_content" => "Gross battery energy content",
        "charging_time_ac_9_6_kw" => "Charging time for AC with 9.6 kW",
        "charging_time_ac_1_1_kw" => "Charging time for AC with 11 kW",
        "charging_time_ac_2_2_kw" => "Charging time for AC with 22 kW",
        "charging_time_dc_400_v" => "Charging time for DC with 400v infra",
        "electric_energy_consumption" => "Electric energy consumption",
        "maximum_charging_power_dc" => "Maximum charging power with DC",
        "fuel_consumption_combined" => "Fuel consumption combined",
        "co2_emissions" => "CO2 emissions",
        "length" => "Length",
        "width" => "Width",
        "wheelbase" => "Wheelbase",
        "height" => "Height",
        "turning_circle" => "Turning circle",
        "maximum_load" => "Maximum load",
        "unladen_weight" => "Unladen weight",
        "permissable_gross_weight" => "Permissable gross weight",
        "approach_departure_angle" => "Approach/departure angle",
        "breakover_angle" => "Breakover angle",
        "ground_clearance" => "Ground clearance",
        "overhang_front_rear" => "Overhang front/rear"
    ];

    public function saveSpecs(Request $request)
    {
        $rules = [
            "variant_id" => "required|exists:variants,id"
        ];

        foreach (array_keys(self::SPEC_FIELDS) as $fieldKey) {
            $rules[$fieldKey] = "nullable|string|max:255";
        }

        $request->validate($rules);

        foreach (self::SPEC_FIELDS as $fieldKey => $label) {
            $value = trim((string) $request->input($fieldKey));

            if ($value !== "") {
                VariantSpec::updateOrCreate(
                    [
                        "variant_id" => $request->variant_id,
                        "key" => $label,
                    ],
                    [
                        "value" => $value,
                    ]
                );
            } else {
                VariantSpec::where("variant_id", $request->variant_id)->where("key", $label)->delete();
            }
        }

        return redirect()->back()->with("success", "Specifications saved successfully");
    }
}
