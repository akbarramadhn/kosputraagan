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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_sewa')
                ->constrained('sewa', 'id_sewa');
            $table->dateTime('tanggal_pembayaran');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->enum('metode_pembayaran', ['E-Wallet', 'Transfer Bank', 'Cash']);
            $table->string('bukti_pembayaran')->nullable();
            $table->string('jenis_pembayaran')->nullable();
            $table->dateTime('tenggat_pembayaran')->nullable();
            $table->enum('status_pembayaran', [
                'Sedang Ditinjau',
                'Terverifikasi',
                'Ditolak'
            ])->nullable();
            $table->enum('tipe_pembayaran', [
                'Sewa Baru',
                'Perpanjang',
                'Pelunasan'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
