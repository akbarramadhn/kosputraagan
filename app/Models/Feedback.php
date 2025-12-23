<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id_feedback';
    public $timestamps = false;

    protected $fillable = [
        'id_penyewa',
        'no_kamar',
        'tanggal_feedback',
        'isi_feedback',
        'status_feedback',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'id_penyewa');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'no_kamar');
    }
}
