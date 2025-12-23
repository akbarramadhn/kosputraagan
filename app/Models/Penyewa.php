<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    protected $table = 'penyewa';
    protected $primaryKey = 'id_penyewa';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'no_telp_penyewa',
        'status_akun',
    ];

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // RELASI KE SEWA (INI YANG PENTING)
    public function sewa()
    {
        return $this->hasMany(
            Sewa::class,
            'id_penyewa',   // foreign key di tabel sewa
            'id_penyewa'    // primary key di tabel penyewa
        );
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'id_penyewa', 'id_penyewa');
    }
}