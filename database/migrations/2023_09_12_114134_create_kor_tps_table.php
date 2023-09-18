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
        Schema::create('kor_tps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik')->unique();
            $table->bigInteger('nokk')->nullable();
            $table->string('nama_koordinator')->nullable();
            $table->unsignedBigInteger('kabkota_id');
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->unsignedBigInteger('kelurahan_id');
            $table->bigInteger('phone')->nullable();
            $table->integer('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('korhan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kor_tps');
    }
};
