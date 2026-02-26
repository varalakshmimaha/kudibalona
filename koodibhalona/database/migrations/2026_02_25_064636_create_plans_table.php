<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('🥉');
            $table->decimal('price', 10, 2);
            $table->string('period')->default('month');
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->string('color')->default('#6a0dad');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('plans'); }
};
