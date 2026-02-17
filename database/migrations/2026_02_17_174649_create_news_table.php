<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->longText('content');
            $table->string('category', 100)->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->unsignedBigInteger('created_by'); 
            $table->foreign('created_by', 'fk_news_user')->references('id')->on('users')->onDelete('cascade'); // Buat relasi manual
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
