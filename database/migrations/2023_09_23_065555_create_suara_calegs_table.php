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
        Schema::create('suara_calegs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tpsrw_id'); 
            $table->foreignId('caleg_id');
            $table->string('suara_caleg')->nullable();
            $table->foreignId('partai_id');
            $table->string('dpr_ri')->nullable();
            $table->string('dpr_prov')->nullable();
            $table->string('dprd')->nullable();
            $table->string('photo');
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suara_calegs');
    }
};
