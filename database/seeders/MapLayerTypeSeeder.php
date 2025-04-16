<?php

namespace Database\Seeders;

use App\Models\MapLayerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapLayerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            ['name' => 'Dịch vụ môi trường rừng'],
            ['name' => 'Rừng ven biển'],
            ['name' => 'Rừng ngập mặn'],
            ['name' => 'Diễn biến rừng'],
            ['name' => 'Bản đồ cấp cháy'],
        ];

        MapLayerType::truncate();
        MapLayerType::insert($arr);
    }
}
