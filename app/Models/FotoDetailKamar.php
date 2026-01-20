<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoDetailKamar extends Model
{
    protected $table = 'kamar_fotos';
    protected $primaryKey = 'id';
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

