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
        $arr = config('user-units');

        $timestamp = now()->format("Y-m-d H:i:s");
        $arr = array_map(function ($item) use ($timestamp) {
            return [
                "name" => $item["name"],
                "abbreviation" => $item["abbreviation"],
                "created_at" => $timestamp,
                "updated_at" => $timestamp,
            ];
        }, $arr);

        UserUnit::truncate();
        UserUnit::insert($arr);
    }
}
