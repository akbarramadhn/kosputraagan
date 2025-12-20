<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'no_kamar';
    public $timestamps = false;

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'no_kamar');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'no_kamar');
    }

    public function foto()
    {
        return $this->hasMany(FotoDetailKamar::class, 'no_kamar');
    }
}
