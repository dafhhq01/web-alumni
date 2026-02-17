<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Galleries: TIDAK pakai softDeletes (hard delete sesuai keputusan teknis)
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('album_name');
            $table->string('image_path');
            $table->year('event_year')->nullable()->index();
            $table->unsignedBigInteger('uploaded_by');
            $table->foreign('uploaded_by', 'fk_galleries_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
