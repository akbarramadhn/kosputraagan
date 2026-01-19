<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $table = 'sewa';
    protected $primaryKey = 'id_sewa';
    public $timestamps = false;

    protected $fillable = [
        'id_penyewa',
        'no_kamar',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_sewa',
        'tanggal_selesai_lama',
    ];

    /**
     * Relasi ke tabel penyewa
     */
    public function penyewa()
    {
        return $this->belongsTo(
            Penyewa::class,
            'id_penyewa',
            'id_penyewa'
        );
    }

    /**
     * ✅ FIXED
     * Relasi ke tabel kamar menggunakan no_kamar
     */
    public function kamar()
    {
        return $this->belongsTo(
            Kamar::class,
            'no_kamar',   // foreign key di tabel sewa
            'no_kamar'    // primary key di tabel kamar
        );
    }

    /**
     * Relasi ke tabel pembayaran
     */
    public function pembayaran()
    {
        return $this->hasMany(
            Pembayaran::class,
            'id_sewa',
            'id_sewa'
        );
    }
}
