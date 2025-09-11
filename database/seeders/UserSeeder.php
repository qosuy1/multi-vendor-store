<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //using model
        User::create(
            [
                'name' => 'admin',
                'email' => 'kosaykm71@gmail.com',
                'password' => Hash::make('123123123'),
                'phone_number'=> '0936362860',
                
            ]
        );


        /*
        // without using model
        DB::insert('insert into users (name , email ,password) values (?, ?,?)', ['Dayle', 'tsest@test.com', 'admin123']);

        DB::table('users')->insert(
            [
                'name' => 'admin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('321321321')
            ]
        );
        */
    }
}
