<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Kategori::create([
            'nama' => 'Makanan'
        ]);

        Kategori::create([
            'nama' => 'Minuman'
        ]);
        Kategori::create([
            'nama' => 'Cemilan'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'username' => 'admin123',
            'password' => Hash::make('password')
        ]);
    }
}
