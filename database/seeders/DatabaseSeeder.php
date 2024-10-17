<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make("password"),
        ]);

        $categories = [
            'Atm (Tarik Tunai)',
            'Cdm (Setor Tunai)',
            'Tst (Tarik dan Setor Tunai)',
            'Main Branch (KC)',
            'Digital Lounge (KCP)',
            'Sub Branch (KCP)',
            'Kiosk',
            'Syariah Main Branch (KCS)',
            'Kantor Fungsional Syariah (KFS)',
            'Syariah Sub Branch (KCPS)',
            'Weekend Banking'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => ucfirst($category)
            ]);
        }
    }
}
