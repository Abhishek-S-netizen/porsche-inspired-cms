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
        Schema::create('engine_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("variant_id")->constrained()->onDelete("cascade");
            $table->string("title");
            $table->text("description");
            $table->integer("position");
            $table->string("engine_image_url")->nullable();
            $table->string("engine_image_public_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engine_details');
    }
};
