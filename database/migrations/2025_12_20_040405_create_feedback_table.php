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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id('id_feedback');
            $table->foreignId('id_penyewa')
                ->nullable()
                ->constrained('penyewa', 'id_penyewa')
                ->cascadeOnDelete();
            $table->foreignId('no_kamar')
                ->constrained('kamar', 'no_kamar');
            $table->dateTime('tanggal_feedback');
            $table->string('isi_feedback');
            $table->enum('status_feedback', [
                'Belum Dibaca',
                'Sudah Dibaca',
                'Sedang Diproses',
                'Selesai Ditangani'
            ])->default('Belum Dibaca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
