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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('price');
            $table->string('image');
            $table->integer('beds');
            $table->integer('bath');
            $table->integer('area_sqft');
            $table->string('home_type');
            $table->year('year_built');
            $table->integer('price_sqft');
            $table->text('more_info');
            $table->string('location');
            $table->string('agent_name');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
