<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoDetailKamar extends Model
{
    protected $table = 'foto_detail_kamar';

    protected $fillable = [
        'no_kamar',
        'nama_file',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'no_kamar');
    }
}
