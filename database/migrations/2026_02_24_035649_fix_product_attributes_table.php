<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('product_attributes', function (Blueprint $table) {

        // Hapus kolom name
        $table->dropColumn('name');

        // Tambah attribute_id
        $table->foreignId('attribute_id')
            ->after('product_id')
            ->constrained('attributes')
            ->cascadeOnDelete();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('product_attributes', function (Blueprint $table) {

        $table->string('name')->after('product_id');
        $table->dropForeign(['attribute_id']);
        $table->dropColumn('attribute_id');

    });
}
};
