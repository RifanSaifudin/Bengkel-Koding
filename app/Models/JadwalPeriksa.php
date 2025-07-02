<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    protected $fillable = ['dokter_id', 'hari', 'jam_mulai', 'jam_selesai', 'status'];

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}