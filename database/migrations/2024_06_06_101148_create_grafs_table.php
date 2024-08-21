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
        Schema::create('grafs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('start');
            $table->unsignedBigInteger('end');
            $table->foreign('start')->references('id')->on('nodes')->cascadeOnDelete();
            $table->foreign('end')->references('id')->on('nodes')->cascadeOnDelete();
            $table->decimal('jarak');
            $table->geometry('rute', subtype: 'linestring')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grafs');
    }
};
