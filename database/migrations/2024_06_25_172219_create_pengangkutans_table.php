<?php

use App\Models\Node;
use App\Models\Transportasi;
use App\Models\User;
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
        Schema::create('pengangkutan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('transportasi_id');
            $table->unsignedBigInteger('lokasi_awal');
            $table->unsignedBigInteger('lokasi_tujuan');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('pengangkut')->nullable();
            $table->foreign('transportasi_id')->references('id')->on('transportasi')->cascadeOnDelete();
            $table->foreign('lokasi_awal')->references('id')->on('nodes')->cascadeOnDelete()->nullable();
            $table->foreign('lokasi_tujuan')->references('id')->on('nodes')->cascadeOnDelete()->nullable();
            $table->string('jarak');
            $table->string('liter')->nullable();
            $table->string('harga')->nullable();
            $table->enum('status',[1,0])->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengangkutan');
    }
};
