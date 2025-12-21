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
        'id_kamar',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_sewa',
    ];

    public function penyewa()
    {
        return $this->belongsTo(
            Penyewa::class,
            'id_penyewa',
            'id_penyewa'
        );
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_sewa');
    }
}