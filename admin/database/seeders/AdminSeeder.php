<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();
        Admin::create([
            "name" => env("APP_NAME"),
            "email" => env("DEFAULT_EMAIL"),
            "password" => bcrypt(env("DEFAULT_PASSWORD")),
            "address" => null,
            "path" => null,
            "id_unit" => 1,
        ]);
    }
}
