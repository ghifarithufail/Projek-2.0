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
        Schema::create('korcams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik')->unique();
            $table->bigInteger('nokk')->nullable();
            $table->string('nama_koordinator')->nullable();
            $table->integer('kabkota_id');
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->integer('kelurahan_id');
            $table->bigInteger('phone')->nullable();
            $table->integer('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('korcams');
    }
};
