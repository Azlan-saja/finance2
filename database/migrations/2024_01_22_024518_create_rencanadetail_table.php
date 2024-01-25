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
        Schema::create('rencanadetail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_id')->index();
            $table->unsignedBigInteger('bagian_id')->default(0);
            $table->string('nama_bagian');            
            $table->timestamps();

            $table->foreign('rencana_id')->references('id')->on('rencana')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencanadetail');
    }
};
