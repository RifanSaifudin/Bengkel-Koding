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
            'name' => 'Rifan',
            'alamat' => 'Jl ini',
            'no_hp' => '081234567',
            'role' => 'dokter',
            'email' => 'rifan@gmail.com',
            'password' => '12345678'
        ],
        [
            'name' => 'Rifan2',
            'alamat' => 'Jl ini',
            'no_hp' => '081234568',
            'role' => 'dokter',
            'email' => 'rifan2@gmail.com',
            'password' => '12345678'
        ],
        [
            'name' => 'Raven',
            'alamat' => 'Jl itu',
            'no_hp' => '087654321',
            'role' => 'pasien',
            'email' => 'raven@gmail.com',
            'password' => '12345678'
        ],
        [
            'name' => 'Raven2',
            'alamat' => 'Jl itu',
            'no_hp' => '087654322',
            'role' => 'pasien',
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
                'email' => $d['email'],
                'password' => bcrypt($d['password']),
            ]);
        }
    }
}