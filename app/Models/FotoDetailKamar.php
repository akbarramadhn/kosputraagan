<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoDetailKamar extends Model
{
    protected $table = 'kamar_fotos';
    protected $primaryKey = 'id_foto';
    public $timestamps = false;

    protected $fillable = [
        'no_kamar',
        'foto_path',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'no_kamar');
    }
}

