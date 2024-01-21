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
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merk');
            $table->unsignedBigInteger('model');
            // $table->string('merk');
            // $table->string('model');
            $table->string('no_plat', 10);
            $table->integer('tarif');
            $table->timestamps();

            $table->foreign('merk')->references('id')->on('merks')->onDelete('cascade');
            $table->foreign('model')->references('id')->on('model_mobils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
