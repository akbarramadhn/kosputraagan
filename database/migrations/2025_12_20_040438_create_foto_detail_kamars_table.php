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
        Schema::create('foto_detail_kamar', function (Blueprint $table) {
            $table->id('id_foto');
            $table->foreignId('no_kamar')
                ->nullable()
                ->constrained('kamar', 'no_kamar')
                ->cascadeOnDelete();
            $table->string('nama_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_detail_kamars');
    }
};
