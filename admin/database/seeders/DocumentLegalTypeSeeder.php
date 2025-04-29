<?php

namespace Database\Seeders;

use App\Models\DocumentLegalType;
use Illuminate\Database\Seeder;

class DocumentLegalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            "Khác",
            "Không Xác Định",
            "Tiêu Chuẩn Việt Nam",
            "Văn Bản",
            "Công Văn",
            "Quyết Định Ubnd Tỉnh",
            "Nghị Quyết Hđnd Tỉnh",
            "Thông Tư Liên Tịch",
            "Quyết Định",
            "Thông Tư",
            "Nghị Định",
            "Hiến Pháp",
            "Luật",
            "Nghị Quyết",
            "Pháp Lệnh",
        ];

        $timestamp = now()->format("Y-m-d H:i:s");
        $arr = array_map(function ($item) use ($timestamp) {
            return [
                "name" => $item,
                "created_at" => $timestamp,
                "updated_at" => $timestamp,
            ];
        }, $arr);

        DocumentLegalType::truncate();
        DocumentLegalType::insert($arr);
    }
}
