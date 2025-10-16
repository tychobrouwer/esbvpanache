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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_nl');
            $table->dateTime('date');
            $table->float('duration')->nullable();
            $table->string('location_en');
            $table->string('location_nl');
            $table->string('cost_en');
            $table->string('cost_nl');
            $table->string('join_en');
            $table->string('join_nl');
            $table->text('content_en');
            $table->text('content_nl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
