<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*  $Clientes=Cliente::all();
        foreach($Clientes as $cliente){
            $cliente->assignRole('Cliente');
        } */

        $users = User::all();
        foreach ($users as $user) {
            $user->assignRole('Cliente');
        }

        User::create([
            'name' => 'Daniel',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'cliente1',
            'email' => 'cliente1@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('Cliente');
    }
}
