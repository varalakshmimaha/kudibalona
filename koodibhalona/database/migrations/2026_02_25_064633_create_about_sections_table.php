<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('main_image')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('title')->default('About Us');
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('about_sections'); }
};
