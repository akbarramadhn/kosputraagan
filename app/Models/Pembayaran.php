<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = [
        'id_sewa', 'tanggal_pembayaran', 'jumlah_bayar',
        'metode_pembayaran', 'bukti_pembayaran',
        'jenis_pembayaran', 'tenggat_pembayaran',
        'status_pembayaran', 'tipe_pembayaran'
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'id_sewa', 'id_sewa');
    }

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
