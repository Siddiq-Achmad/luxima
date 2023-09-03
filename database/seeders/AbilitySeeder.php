<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Ability::create([
            'role_id' => 1,
            'name' => 'Super Admin',
            'action' => 'manage',
            'subject' => 'all'
        ]);
    }
}
