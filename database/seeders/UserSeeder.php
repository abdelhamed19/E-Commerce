<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeding Using Model
//        User::create([
//            "name"=>"abdelhamed",
//            "email"=>"Houmoud@ho.com",
//            "password"=>Hash::make("password")
//        ]);

        // Seeding Using Query Builder
//        DB::table("users")->insert([
//            "name"=>"abdelhamed",
//            "email"=>"Houmoud@ho.com",
//            "password"=>Hash::make("password")]);
    }
}
