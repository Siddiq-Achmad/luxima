<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Role::create([
            'name' => 'Admin',
            'description' => 'Administrator',
        ]);
        \App\Models\Role::create([
            'name' => 'Manager',
            'description' => 'Manager Role',
        ]);
        \App\Models\Role::create([
            'name' => 'Staff',
            'description' => 'Staff Role',
        ]);
        \App\Models\Role::create([
            'name' => 'Vendor',
            'description' => 'Vendor Role',
        ]);
        \App\Models\Role::create([
            'name' => 'Client',
            'description' => 'Client Role',
        ]);
        \App\Models\Role::create([
            'name' => 'User',
            'description' => 'User Role',
        ]);
    }
}
