<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'no_kamar';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'foto_kos',
        'tipe_kamar',
        'harga_perbulan',
        'status',
        'deskripsi',
        'fasilitas',
    ];

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'no_kamar');
    }

    public function getRouteKeyName()
    {
        return 'no_kamar';
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'no_kamar');
    }

    public function fotoDetail()
    {
        return $this->hasMany(FotoDetailKamar::class, 'no_kamar');
    }
}
