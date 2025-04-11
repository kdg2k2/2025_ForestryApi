<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            "Admin",
            "User",
        ];

        $arr = array_map(function ($item) {
            return [
                "name" => $item,
                "created_at" => now()->format("Y-m-d H:i:s"),
                "updated_at" => now()->format("Y-m-d H:i:s"),
            ];
        }, $arr);

        UserRole::truncate();
        UserRole::insert($arr);
    }
}
