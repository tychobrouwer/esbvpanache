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
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique();
            $table->string('chairperson');
            $table->string('vice_chairperson');
            $table->string('secretary');
            $table->string('treasurer');
            $table->string('slogan');
            $table->text('message_en')->nullable();
            $table->text('message_nl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
