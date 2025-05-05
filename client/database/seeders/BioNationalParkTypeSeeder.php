<?php

namespace Database\Seeders;

use App\Models\BioNationalParkType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BioNationalParkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            ["name" => "VQG thuộc Bộ"],
            ["name" => "VQG thuộc Tỉnh"],
            ["name" => "Ban QLRĐD-PH"],
            ["name" => "Khu bảo tồn"],
            ["name" => "Khác"],
        ];

        BioNationalParkType::truncate();
        BioNationalParkType::insert($arr);
    }
}
