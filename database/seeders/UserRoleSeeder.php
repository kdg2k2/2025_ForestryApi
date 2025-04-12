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
            [
                "name_en" => "Admin",
                "name_vn" => "Quản Trị Viên",
            ],
            [
                "name_en" => "Forester Command",
                "name_vn" => "Chỉ Huy Chiến Lược Lâm Nghiệp",
            ],
            [
                "name_en" => "Forester Insight",
                "name_vn" => "Thấu Hiểu Dữ Liệu Lâm Nghiệp",
            ],
            [
                "name_en" => "Forester Connect",
                "name_vn" => "Kết Nối Thông Tin Lâm Nghiệp",
            ],
            [
                "name_en" => "Forester Start",
                "name_vn" => "Miễn Phí",
            ],
        ];

        $arr = array_map(function ($item) {
            return [
                "name_en" => $item["name_en"],
                "name_vn" => $item["name_vn"],
                "created_at" => now()->format("Y-m-d H:i:s"),
                "updated_at" => now()->format("Y-m-d H:i:s"),
            ];
        }, $arr);

        UserRole::truncate();
        UserRole::insert($arr);
    }
}
