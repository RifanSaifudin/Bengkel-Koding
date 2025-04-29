<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_periksa extends Model
{
    protected $table = 'detail_periksas';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_periksa',
        'id_obat'
    ];

    // Relasi dengan Periksa
    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }

    // Relasi dengan Obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}