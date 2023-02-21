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
            'description' => 'Manager Roles',
        ]);
        \App\Models\Role::create([
            'name' => 'Staff',
            'description' => 'Staff Roles',
        ]);
        \App\Models\Role::create([
            'name' => 'Vendor',
            'description' => 'Vendor Roles',
        ]);
        \App\Models\Role::create([
            'name' => 'Client',
            'description' => 'Client Roles',
        ]);
        \App\Models\Role::create([
            'name' => 'User',
            'description' => 'User Roles',
        ]);

    }
}
