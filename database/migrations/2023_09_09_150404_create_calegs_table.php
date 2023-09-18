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
        Schema::create('calegs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partai_id');
            $table->string('namacaleg');
            $table->integer('no_urut')->nullable();
            $table->string('jk');
            $table->string('kandidat');
            $table->unsignedBigInteger('dapil_id');
            $table->string('status');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calegs');
    }
};
