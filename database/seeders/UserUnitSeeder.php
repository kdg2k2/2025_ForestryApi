<?php

namespace Database\Seeders;

use App\Models\UserUnit;
use Illuminate\Database\Seeder;

class UserUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now()->format("Y-m-d H:i:s");
        $arr = [
            [
                "name" => "Khác",
                "abbreviation" => null,
            ],
            [
                "name" => "Viện Sinh thái rừng và Môi trường",
                "abbreviation" => "IFEE",
            ],
            [
                "name" => "Công ty Cổ phần Thương mại Công nghệ Xuân Mai Green",
                "abbreviation" => "XMG",
            ],
            [
                "name" => "Đại Học Lâm Nghiệp",
                "abbreviation" => "VNUF",
            ],
            [
                "name" => "Cục Kiểm Lâm",
                "abbreviation" => null,
            ],
            [
                "name" => "Cục Lâm Nghiệp",
                "abbreviation" => "VNFOREST",
            ],
            [
                "name" => "Quỹ Bảo Vệ Và Phát Triển Rừng Việt Nam",
                "abbreviation" => "VNFF",
            ],
        ];

        $timestamp = now()->format("Y-m-d H:i:s");
        $arr = array_map(function ($item) use ($timestamp) {
            return [
                "name" => $item["name"],
                "abbreviation" => $item["abbreviation"],
                "created_at" => $timestamp,
                "updated_at" => $timestamp,
            ];
        }, $arr);

        UserUnit::truncate();
        UserUnit::insert($arr);
    }
}
