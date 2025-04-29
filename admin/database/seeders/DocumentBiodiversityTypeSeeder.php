<?php

namespace Database\Seeders;

use App\Models\DocumentBiodiversityType;
use Illuminate\Database\Seeder;

class DocumentBiodiversityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            "Khác",
            "Động Vật",
            "Thực Vật",
        ];

        $timestamp = now()->format("Y-m-d H:i:s");
        $arr = array_map(function ($item) use ($timestamp) {
            return [
                "name" => $item,
                "created_at" => $timestamp,
                "updated_at" => $timestamp,
            ];
        }, $arr);

        DocumentBiodiversityType::insert($arr);
    }
}
