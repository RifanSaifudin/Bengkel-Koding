<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periksa extends Model
{
    use HasFactory;

    protected $table = 'periksas';

    // Menonaktifkan penggunaan created_at dan updated_at
    public $timestamps = false;

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'poli_id',
        'jadwal_id',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
        'diagnosa',
        'no_antrian',
        'status',
    ];

    // Relasi dengan model User (Pasien)
    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    // Relasi dengan model User (Dokter)
    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter');
    }

    // Relasi Many-to-Many dengan Obat melalui detail_periksa
    public function obat()
    {
        return $this->belongsToMany(Obat::class, 'detail_periksa', 'periksa_id', 'obat_id');
    }

    // Relasi dengan DetailPeriksa
    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'jadwal_id');
    }

}