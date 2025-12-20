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
        Schema::create('kamar', function (Blueprint $table) {
            $table->id('no_kamar');
            $table->string('foto_kos');
            $table->enum('tipe_kamar', ['A', 'B', 'C']);
            $table->decimal('harga_perbulan', 10, 2);
            $table->enum('status', ['Kosong', 'Isi']);
            $table->text('deskripsi')->nullable();
            $table->string('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
