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
        Schema::create('koordinator_tpsrws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('koordinator_id');
            $table->unsignedBigInteger('tpsrw_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koordinator_tpsrws');
    }
};
