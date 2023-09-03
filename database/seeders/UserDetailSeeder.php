<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\UserDetail::create([
            'user_id'    => 1,
            'first_name' => 'Administrator',
            'last_name' => 'LUXIMA.ID',
            'job_title' => 'Administrator',
            'phone_number' => '0000000000',
            'organization' => 'LUXIMA.ID',
            'address' => 'Jl. DR. IR. H. Mohd Hasan no. 257',
            'city' => 'Banda Aceh',
            'state' => 'Aceh',
            'country' => 'Indonesia',
            'language' => 'ID',
            'website' => 'www.luxima.id',
            'avatar' => '',
        ]);
    }
}
