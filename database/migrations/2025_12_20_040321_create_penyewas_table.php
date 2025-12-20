<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyewa', function (Blueprint $table) {
            $table->id('id_penyewa');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('no_telp_penyewa');
            $table->enum('status_akun', [
                'Menunggu Verifikasi',
                'Terverifikasi',
                'Umum'
            ])->default('Umum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewas');
    }
};
