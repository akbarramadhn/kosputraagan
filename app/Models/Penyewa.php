<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    protected $table = 'penyewa';
    protected $primaryKey = 'id_penyewa';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'no_telp_penyewa',
        'status_akun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'id_penyewa');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'id_penyewa');
    }
}
