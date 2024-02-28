<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'	=> 'admin',
            'nip'	=> '202402240001',
            'password'	=> bcrypt('admin'),
            'role' => 'admin'
        ]);
    }
}
