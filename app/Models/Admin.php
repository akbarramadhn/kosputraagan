<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'nama_admin',
        'email_admin',
        'no_telp_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}