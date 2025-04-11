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
                "name" => "Viện Sinh thái rừng và Môi trường",
                "abbreviation" => "IFEE",
                "phone" => "02466830212",
                "email" => "info@ifee.edu.vn",
                "address" => "Tầng 1, Nhà A3, Trường Đại học Lâm nghiệp, TT Xuân Mai, H Chương Mỹ, TP Hà Nội",
                "created_at" => $timestamp,
                "updated_at" => $timestamp,
            ],
            [
                "name" => "Công ty Cổ phần Thương mại Công nghệ Xuân Mai Green",
                "abbreviation" => "XMG",
                "phone" => "02466515880",
                "email" => "xuanmaigreen@gmail.com",
                "address" => "Số nhà 86, Tổ 3, Tân Mai, TT Xuân Mai, Huyện Chương Mỹ, Hà Nội",
                "created_at" => $timestamp,
                "updated_at" => $timestamp,
            ],
        ];

        UserUnit::truncate();
        UserUnit::insert($arr);
    }
}
