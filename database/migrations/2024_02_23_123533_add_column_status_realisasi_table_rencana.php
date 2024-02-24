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
        Schema::table('rencana', function (Blueprint $table) {
            $table->enum('status_realisasi', ['Waiting','Open', 'Closed'])->after('status')->default('Waiting');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rencana', function (Blueprint $table) {
             $table->dropColumn('status_realisasi');
        });
    }
};
