<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FotoDetailKamar;
use App\Models\Sewa;        // ➕ TAMBAHAN
use App\Models\Feedback;   // ➕ TAMBAHAN

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'no_kamar';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'tipe_kamar',
        'harga_perbulan',
        'status',
        'deskripsi',
        'fasilitas',
        'foto_kos',
    ];

    // 🔹 RELASI MULTIPLE FOTO (KODE LAMA)
    public function fotoDetail()
    {
        return $this->hasMany(FotoDetailKamar::class, 'no_kamar', 'no_kamar');
    }

    // ➕ RELASI SEWA (TAMBAHAN)
    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'no_kamar', 'no_kamar');
    }

    // ➕ RELASI FEEDBACK (TAMBAHAN)
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'no_kamar', 'no_kamar');
    }
}
