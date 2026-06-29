<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId("car_id")->constrained()->onDelete("cascade");
            $table->string("variant");
            $table->string("slug")->unique();
            $table->year("year")->nullable();
            $table->enum("fuel_type",["Gasoline","Electric","Hybrid"]);
            $table->string("gearbox")->nullable();
            $table->string("title");
            $table->text("title_content");
            $table->text("drive_content");
            $table->integer("order_index");
            $table->text("gallery_content")->nullable();
            $table->string("parallax_image_url");
            $table->string("parallax_image_public_id");
            $table->string("side_profile_url");
            $table->string("side_profile_public_id");
            $table->string("front_profile_url");
            $table->string("front_profile_public_id");
            $table->string("drive_parallax_url");
            $table->string("drive_parallax_public_id");
            $table->string("gallery_1_url");
            $table->string("gallery_1_public_id");
            $table->string("gallery_2_url");
            $table->string("gallery_2_public_id");
            $table->string("gallery_3_url");
            $table->string("gallery_3_public_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
