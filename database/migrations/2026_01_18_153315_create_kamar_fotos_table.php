<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamar_fotos', function (Blueprint $table) {
            $table->id(); // PK tabel kamar_fotos (bukan no_kamar)

            $table->unsignedBigInteger('no_kamar'); // FK ke kamar.no_kamar

            $table->foreign('no_kamar')
                ->references('no_kamar')
                ->on('kamar')
                ->cascadeOnDelete();

            $table->string('foto_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamar_fotos');
    }
};
