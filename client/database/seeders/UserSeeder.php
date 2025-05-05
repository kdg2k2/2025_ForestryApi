<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        User::create([
            "name" => env("APP_NAME"),
            "email" => env("DEFAULT_EMAIL"),
            "password" => bcrypt(env("DEFAULT_PASSWORD")),
            "address" => null,
            "path" => null,
            "id_role" => 1,
            "id_unit" => 1,
        ]);
    }
}
