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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nokk')->nullable();
            $table->string('nama_anggota');
            $table->unsignedBigInteger('kabkota_id');
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt',3);
            $table->string('rw', 3);
            $table->unsignedBigInteger('tpsrw_id');
            $table->string('phone')->nullable();
            $table->string('status');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('koordinator_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
