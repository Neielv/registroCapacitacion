<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'ci'=>'0123456789',
            'name'=>'Administrador del sistema',
            'email'=>'admin@gmail.com',
            'phone'=>'0995814087',
            'password'=>bcrypt('12345678'),
            'rol_id'=>1         
        ])->assignRole('Admin')
        ;
    }
}