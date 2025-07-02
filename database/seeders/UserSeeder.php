<?php


namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
        [
            'name' => 'Admin',
            'alamat' => 'Jl Admin',
            'no_hp' => '0800000000',
            'role' => 'admin',
            'id_poli' => null,
            'email' => 'admin@gmail.com',
            'password' => '12345678'
        ],
        [
            'name' => 'Rifan',
            'alamat' => 'Jl ini',
            'no_hp' => '081234567',
            'role' => 'dokter',
            'id_poli' => 1,
            'email' => 'rifan@gmail.com',
            'password' => '12345678'
        ],
        [
            'name' => 'Rifan2',
            'alamat' => 'Jl ini',
            'no_hp' => '081234568',
            'role' => 'dokter',
            'id_poli' => 2,
            'email' => 'rifan2@gmail.com',
            'password' => '12345678'
        ],
        [
            'name' => 'Raven',
            'alamat' => 'Jl itu',
            'no_hp' => '087654321',
            'role' => 'pasien',
            'id_poli' => null, // pasien tidak perlu
            'email' => 'raven@gmail.com',
            'password' => '12345678'
        ],
        [
            'name' => 'Raven2',
            'alamat' => 'Jl itu',
            'no_hp' => '087654322',
            'role' => 'pasien',
            'id_poli' => null, // pasien tidak perlu
            'email' => 'raven2@gmail.com',
            'password' => '12345678'
        ],
        
        ];
        foreach($data as $d){
            User::create([
                'name' => $d['name'],
                'alamat' => $d['alamat'],
                'no_hp' => $d['no_hp'],
                'role' => $d['role'],
                'id_poli' => $d['id_poli'],
                'email' => $d['email'],
                'password' => bcrypt($d['password']),
            ]);
        }
    }
}