<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
            $table->string('full_name');
            $table->string('angkatan', 10)->nullable()->index();
            $table->year('graduation_year')->nullable()->index();
            $table->string('phone_number', 20)->nullable();
            $table->string('current_job')->nullable();
            $table->string('company')->nullable();
            $table->text('address')->nullable();
            $table->json('social_media_links')->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->boolean('is_verified')->default(false)->index();
            $table->boolean('is_private')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni_profiles');
    }
};