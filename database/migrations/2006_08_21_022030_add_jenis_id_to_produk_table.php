<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('produk') && ! Schema::hasColumn('produk', 'jenis_id')) {
            Schema::table('produk', function (Blueprint $table) {
                $table->foreignId('jenis_id')
                    ->nullable()
                    ->after('user_id')
                    ->constrained('jenis', 'id')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('produk') && Schema::hasColumn('produk', 'jenis_id')) {
            Schema::table('produk', function (Blueprint $table) {
                $table->dropForeign(['jenis_id']);
                $table->dropColumn('jenis_id');
            });
        }
    }
};