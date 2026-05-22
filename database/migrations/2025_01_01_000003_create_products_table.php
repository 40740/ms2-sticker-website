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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->json('features')->nullable();
            $table->string('steps_title')->nullable();
            $table->json('steps')->nullable();
            $table->json('concerns')->nullable();
            $table->json('testimonials')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
