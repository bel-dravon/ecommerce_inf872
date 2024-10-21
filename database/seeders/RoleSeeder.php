<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach($users as $user){
            
        }   

        $roleAdmin= Role::create([
            'name'=>'Admin'
        ]);
        //roel de cliente
        $roleCliente= Role::create([
            'name'=>'Cliente'
        ]);

        Permission::create([
            'name'=>'Admin.index'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name'=>'Admin.create'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name'=>'Admin.edit'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name'=>'Admin.destroy'
        ])->assignRole($roleAdmin);
        //permisos para cliente
        Permission::create([
            'name'=>'Cliente.index'
        ])->assignRole($roleCliente);
        Permission::create([
            'name'=>'Cliente.create'
        ])->assignRole($roleCliente);
        Permission::create([
            'name'=>'Cliente.edit'
        ])->assignRole($roleCliente);
        Permission::create([
            'name'=>'Cliente.destroy'
        ])->assignRole($roleCliente);
    }
}