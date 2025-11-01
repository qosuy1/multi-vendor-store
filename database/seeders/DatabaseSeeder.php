<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
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



        // $this->call(UserSeeder::class);

        // Store::factory(5)->create();
        // Category::factory(10)->create();
        // Product::factory(100)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('321321321'),
        //     'store_id' => 3
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'User 1',
        //     'email' => 'user1@example.com',
        //     'password' => Hash::make('321321321'),
        //     'store_id' => 4
        // ]);
        Admin::factory(10)->create();
    }
}
