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
            "Thư viện số",
            "Bài trình bày hội thảo",
            "Sổ tay",
            "Kỷ yếu",
            "Giáo trình",
            "Sách tham khảo",
            "Bài báo",
            "Hồ sơ năng lực",
        ];

        $arr = array_map(function ($item) {
            return [
                "name" => $item,
                "created_at" => now()->format("Y-m-d H:i:s"),
                "updated_at" => now()->format("Y-m-d H:i:s"),
            ];
        }, $arr);

        DocumentScientificPublicationType::insert($arr);
    }
}
