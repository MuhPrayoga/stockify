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
    DB::statement("
        ALTER TABLE stock_transactions 
        MODIFY status ENUM('Pending','Diterima','Ditolak','Dikeluarkan','Selesai')
        DEFAULT 'pending'
    ");
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_transactions', function (Blueprint $table) {
            //
        });
    }
};
