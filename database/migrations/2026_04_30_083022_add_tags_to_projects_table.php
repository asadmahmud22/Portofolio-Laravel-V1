<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah kolom tags sudah ada
        if (!Schema::hasColumn('projects', 'tags')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('tags')->nullable()->after('description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('projects', 'tags')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('tags');
            });
        }
    }
};