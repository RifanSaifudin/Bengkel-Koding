<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        Poli::insert([
            ['id' => 1, 'nama_poli' => 'Poli Umum'],
            ['id' => 2, 'nama_poli' => 'Poli Gigi'],
            ['id' => 3, 'nama_poli' => 'Poli Anak'],
        ]);
    }
}
