<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            if (! Schema::hasColumn('galeris', 'jenis_media')) {
                $table->enum('jenis_media', ['foto', 'video'])->default('foto')->after('path_file');
            }
            if (! Schema::hasColumn('galeris', 'mime_type')) {
                $table->string('mime_type')->nullable()->after('jenis_media');
            }
            if (! Schema::hasColumn('galeris', 'ukuran_file')) {
                $table->unsignedBigInteger('ukuran_file')->nullable()->after('mime_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            if (Schema::hasColumn('galeris', 'ukuran_file')) {
                $table->dropColumn('ukuran_file');
            }
            if (Schema::hasColumn('galeris', 'mime_type')) {
                $table->dropColumn('mime_type');
            }
            if (Schema::hasColumn('galeris', 'jenis_media')) {
                $table->dropColumn('jenis_media');
            }
        });
    }
};
