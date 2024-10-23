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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->longText('priority')->nullable();
            $table->foreignId('category_id')->constrained('categories'); 
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->tinyInteger('is_popular')->default(0);
            $table->tinyInteger('is_home_show')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
