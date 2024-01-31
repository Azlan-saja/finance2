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
        Schema::table('realisasi', function (Blueprint $table) {
            $table->tinyInteger('bagian_id')->after('rencana_detail_kegiatan_id')->default(0);
            $table->tinyInteger('subbagian_id')->after('rencana_detail_kegiatan_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('realisasi', function (Blueprint $table) {
            //
        });
    }
};
