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
        Schema::create('info_kos', function (Blueprint $table) {
            $table->id('id_info');
            $table->string('gambar')->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('kategori', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_kos');
    }
};
