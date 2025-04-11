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
            "Tiêu chuẩn Việt Nam",
            "Văn bản",
            "Công văn",
            "Quyết định UBND tỉnh",
            "Nghị quyết HĐND tỉnh",
            "Thông tư liên tịch",
            "Quyết định",
            "Thông tư",
            "Nghị định",
        ];

        $arr = array_map(function ($item) {
            return [
                "name" => $item,
                "created_at" => now()->format("Y-m-d H:i:s"),
                "updated_at" => now()->format("Y-m-d H:i:s"),
            ];
        }, $arr);

        DocumentLegalType::insert($arr);
    }
}
