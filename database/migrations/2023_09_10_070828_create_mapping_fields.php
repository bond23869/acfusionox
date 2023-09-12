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
        Schema::create('mapping_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapping_id');
            $table->unsignedBigInteger('field_id');
            $table->integer('content_location');
            $table->timestamps();

            $table->foreign('mapping_id')->references('id')->on('mappings')->onDelete('cascade');
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapping_fields');
    }
};
