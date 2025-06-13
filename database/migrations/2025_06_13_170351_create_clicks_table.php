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
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained();
            $table->integer('x');
            $table->integer('y');
            $table->integer('width');
            $table->integer('height');
            $table->string('path');
            $table->timestamp('datetime');
            $table->timestamps();
        });

    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clicks');
    }
};
