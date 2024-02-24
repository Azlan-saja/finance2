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
            if (Schema::hasColumn('realisasi', 'pdf_1')){
                Schema::table('realisasi', function (Blueprint $table) {
                    $table->dropColumn('pdf_1');
                });
            }
            $table->string('pdf_1')->after('b1')->nullable();
            $table->string('pdf_2')->after('b2')->nullable();
            $table->string('pdf_3')->after('b3')->nullable();
            $table->string('pdf_4')->after('b4')->nullable();
            $table->string('pdf_5')->after('b5')->nullable();
            $table->string('pdf_6')->after('b6')->nullable();
            $table->string('pdf_7')->after('b7')->nullable();
            $table->string('pdf_8')->after('b8')->nullable();
            $table->string('pdf_9')->after('b9')->nullable();
            $table->string('pdf_10')->after('b10')->nullable();
            $table->string('pdf_11')->after('b11')->nullable();
            $table->string('pdf_12')->after('b12')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('realisasi', function (Blueprint $table) {
             $table->dropColumn(['pdf_1','pdf_2','pdf_3','pdf_4','pdf_5','pdf_6','pdf_7','pdf_8','pdf_9','pdf_10','pdf_11','pdf_12']);
        });
    }
};
