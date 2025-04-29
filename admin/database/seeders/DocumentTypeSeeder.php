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
            "Văn Bản Pháp Lý",
            "Ấn Phẩm Khoa Học",
            "Đa Dạng Sinh Học",
            "Quyền Tác Giả",
            "Chứng Nhận",
            "Hồ Sơ Năng Lực",
            "Rừng Ven Biển",
            "Đề Án Dlst",
            "Tài Liệu Tham Khảo",
            "Đề Tài/Dự Án/Nhiệm Vụ",
            "Bài Giảng",
            "Sổ Tay/Tài Liệu Hướng Dẫn",
            "Công Văn/Văn Bản",
        ];

        $timestamp = now()->format("Y-m-d H:i:s");
        $arr = array_map(function ($item) use ($timestamp) {
            return [
                "name" => $item,
                "created_at" => $timestamp,
                "updated_at" => $timestamp,
            ];
        }, $arr);

        DocumentType::truncate();
        DocumentType::insert($arr);
    }
}
