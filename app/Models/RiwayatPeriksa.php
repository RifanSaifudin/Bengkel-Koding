<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPeriksa extends Model
{
    use HasFactory;

    protected $table = 'riwayat_periksa'; // sesuai migration
    protected $fillable = ['pasien_id', 'dokter_id', 'tanggal', 'keluhan', 'diagnosa'];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'riwayat_periksa_obat');
    }
}