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
        DB::table('rencanadetailkegiatan')
            ->update(['jumlah_sasaran' => 1]);

        Schema::table('rencanadetailkegiatan', function (Blueprint $table) {
            $table->integer('jumlah_sasaran')->unsigned()->default(1)->comment('ubah string to int')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rencanadetailkegiatan', function (Blueprint $table) {
            //
        });
    }
};
