<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'no_hp',
        'id_poli',
        'role',
        'no_ktp',
        'no_rm',
    ];

    public function poli() 
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function periksa()
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    public function periksaSebagaiDokter() 
    {
        return $this->hasMany(Periksa::class, 'id_dokter');
    }

    public function periksaSebagaiPasien() 
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    public function jadwals()
    {
        return $this->hasMany(JadwalPeriksa::class, 'dokter_id');
    }
}
