<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoDetailKamar extends Model
{
    protected $table = 'foto_detail_kamar';
    protected $primaryKey = 'id_foto';
    public $timestamps = false;

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'no_kamar');
    }
}
