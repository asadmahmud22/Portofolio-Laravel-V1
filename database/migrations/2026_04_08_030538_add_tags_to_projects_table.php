<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->string('tags')->nullable()->after('description');
            $table->string('url')->nullable()->after('tags');
            $table->string('github_url')->nullable()->after('url');
            $table->string('image')->nullable()->after('github_url');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'tags',
                'url',
                'github_url',
                'image'
            ]);
        });
    }
};