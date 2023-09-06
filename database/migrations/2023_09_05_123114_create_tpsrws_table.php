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
        Schema::create('tpsrws', function (Blueprint $table) {
            $table->id();
            $table->integer('kelurahan_id');
            $table->string('tps');
            $table->string('totdpt')->nullable();
            $table->string('dptl')->nullable();
            $table->string('dptp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tpsrws');
    }
};
