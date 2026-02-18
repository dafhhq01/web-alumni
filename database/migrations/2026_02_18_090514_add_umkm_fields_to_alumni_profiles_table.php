<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->boolean('has_business')->default(false); // Penanda punya usaha
            $table->string('business_name')->nullable();
            $table->string('business_type')->nullable(); // Contoh: Kuliner, Jasa, IT
            $table->string('business_photo')->nullable(); // Simpan path foto
            $table->text('business_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'has_business',
                'business_name',
                'business_type',
                'business_photo',
                'business_description'
            ]);
        });
    }
};
