<?php

namespace Database\Seeders;

use App\Models\DocumentScientificPublicationType;
use Illuminate\Database\Seeder;

class DocumentScientificPublicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            "Khác",
            "Thư Viện Số",
            "Bài Trình Bày Hội Thảo",
            "Sổ Tay",
            "Kỷ Yếu",
            "Giáo Trình",
            "Sách Tham Khảo",
            "Bài Báo",
            "Hồ Sơ Năng Lực",
            "Sách",
        ];

        $timestamp = now()->format("Y-m-d H:i:s");
        $arr = array_map(function ($item) use ($timestamp) {
            return [
                "name" => $item,
                "created_at" => $timestamp,
                "updated_at" => $timestamp,
            ];
        }, $arr);

        DocumentScientificPublicationType::truncate();
        DocumentScientificPublicationType::insert($arr);
    }
}
