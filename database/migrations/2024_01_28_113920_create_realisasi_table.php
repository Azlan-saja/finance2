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
        Schema::create('realisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_id')->index();
            $table->unsignedBigInteger('rencana_detail_id')->index();
            $table->unsignedBigInteger('rencana_detail_subbagian_id')->index();
            $table->unsignedBigInteger('rencana_detail_kegiatan_id')->index();
            $table->double('b1')->default(0);
            $table->double('b2')->default(0);
            $table->double('b3')->default(0);
            $table->double('b4')->default(0);
            $table->double('b5')->default(0);
            $table->double('b6')->default(0);
            $table->double('b7')->default(0);
            $table->double('b8')->default(0);
            $table->double('b9')->default(0);
            $table->double('b10')->default(0);
            $table->double('b11')->default(0);
            $table->double('b12')->default(0);
            $table->timestamps();
            $table->foreign('rencana_id')->references('id')->on('rencana')->cascadeOnDelete();
            $table->foreign('rencana_detail_id')->references('id')->on('rencanadetail')->cascadeOnDelete();
            $table->foreign('rencana_detail_subbagian_id')->references('id')->on('rencanadetailsubbagian')->cascadeOnDelete();
            $table->foreign('rencana_detail_kegiatan_id')->references('id')->on('rencanadetailkegiatan')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi');
    }
};
