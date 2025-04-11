<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            "Khác",
            "Văn bản pháp lý",
            "Ấn phẩm khoa học",
            "Quyền tác giả",
            "Chứng nhận",
            "Hồ sơ năng lực",
            "Rừng ven biển",
            "Đề án DLST",
            "Tài liệu tham khảo",
            "Đề tài/Dự án/Nhiệm vụ",
            "Bài giảng",
            "Sổ tay/Tài liệu hướng dẫn",
            "Công văn/Văn bản",
        ];

        $arr = array_map(function ($item) {
            return [
                "name" => $item,
                "created_at" => now()->format("Y-m-d H:i:s"),
                "updated_at" => now()->format("Y-m-d H:i:s"),
            ];
        }, $arr);

        DocumentType::insert($arr);
    }
}
