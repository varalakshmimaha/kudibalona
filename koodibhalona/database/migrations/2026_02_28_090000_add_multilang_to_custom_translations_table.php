<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_translations', function (Blueprint $table) {
            $table->string('telugu_word')->nullable()->after('kannada_word');
            $table->string('hindi_word')->nullable()->after('telugu_word');
            $table->string('tamil_word')->nullable()->after('hindi_word');
            $table->string('category')->default('general')->after('tamil_word');
            $table->text('description')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('custom_translations', function (Blueprint $table) {
            $table->dropColumn(['telugu_word', 'hindi_word', 'tamil_word', 'category', 'description']);
        });
    }
};
