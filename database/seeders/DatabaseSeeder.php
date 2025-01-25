<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(999)->create();
        \App\Models\User::factory()->create([
            'name' => 'Alvaro Japa Salazar',
            'password' => 'Alva100@ing',
            'email' => 'jalvarojs123@hotmail.com',
            'birth_date' => '1998-02-14',
        ]);
    }
}
