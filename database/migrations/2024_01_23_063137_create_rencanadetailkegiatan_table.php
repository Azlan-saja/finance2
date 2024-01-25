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
        Schema::create('rencanadetailkegiatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_id')->index();
            $table->unsignedBigInteger('rencana_detail_id')->index();
            $table->unsignedBigInteger('rencana_detail_subbagian_id')->index();
            $table->unsignedBigInteger('subbagian_id')->default(0);
            $table->string('nama_kegiatan');   
            $table->string('sasaran');   
            $table->string('anggaran');   
            $table->string('satuan');   
            $table->string('jumlah_sasaran');   
            $table->integer('volume');   
            $table->double('harga');   
            $table->timestamps();

            $table->foreign('rencana_detail_subbagian_id')->references('id')->on('rencanadetailsubbagian')->cascadeOnDelete();
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencanadetailkegiatan');
    }
};
