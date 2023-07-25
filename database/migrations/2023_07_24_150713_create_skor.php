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
        Schema::create('skor', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('klub_1', 20);
            $table->string('klub_2', 20);
            $table->unsignedInteger('skor_klub_1');
            $table->unsignedInteger('skor_klub_2');
            // Foreign Key Set
            $table->foreign('klub_1')->on('klub')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('klub_2')->on('klub')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skor');
    }
};
