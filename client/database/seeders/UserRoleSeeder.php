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
        $arr = config('user-roles');

        $arr = array_map(function ($item) {
            return [
                "name_en" => $item["name_en"],
                "name_vn" => $item["name_vn"],
                "price" => $item["price"],
                "download_limit_per_month" => $item["download_limit_per_month"],
                "view_limit_per_month" => $item["view_limit_per_month"],
                "page_view_limit" => $item["page_view_limit"],
                "created_at" => now()->format("Y-m-d H:i:s"),
                "updated_at" => now()->format("Y-m-d H:i:s"),
            ];
        }, $arr);

        UserRole::truncate();
        UserRole::insert($arr);
    }
}
