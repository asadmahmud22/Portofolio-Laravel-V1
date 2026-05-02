<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            if (!Schema::hasColumn('projects', 'tags')) {
                $table->text('tags')->nullable()->after('description');
            }

            if (!Schema::hasColumn('projects', 'url')) {
                $table->string('url')->nullable()->after('tags');
            }

            if (!Schema::hasColumn('projects', 'github_url')) {
                $table->string('github_url')->nullable()->after('url');
            }

            if (!Schema::hasColumn('projects', 'image')) {
                $table->string('image')->nullable()->after('github_url');
            }

        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('projects', 'tags')) {
                $columns[] = 'tags';
            }

            if (Schema::hasColumn('projects', 'url')) {
                $columns[] = 'url';
            }

            if (Schema::hasColumn('projects', 'github_url')) {
                $columns[] = 'github_url';
            }

            if (Schema::hasColumn('projects', 'image')) {
                $columns[] = 'image';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }

        });
    }
};