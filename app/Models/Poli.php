<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poli extends Model
{
    use HasFactory;

    protected $fillable = ['nama_poli', 'deskripsi'];

    public function dokters()
    {
        return $this->hasMany(User::class, 'id_poli');
    }

}