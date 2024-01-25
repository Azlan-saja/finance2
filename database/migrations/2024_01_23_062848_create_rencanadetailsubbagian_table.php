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
        Schema::create('rencanadetailsubbagian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_detail_id')->index();
            $table->unsignedBigInteger('subbagian_id')->default(0);
            $table->string('nama_subbagian');            
            $table->timestamps();

            $table->foreign('rencana_detail_id')->references('id')->on('rencanadetail')->cascadeOnDelete();
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencanadetailsubbagian');
    }
};
