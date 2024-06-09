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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enduser_id');
            $table->string('username', 256);
            $table->text('bio')->nullable();
            $table->integer('totalLevel')->nullable();
            $table->integer('questPoints');
            $table->string('image', 256)->nullable();
            //$table->boolean('display');
            $table->integer('collectionLogSlots');
            $table->timestamps();
            $table->foreign('enduser_id')->references('id')->on('endusers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
