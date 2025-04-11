<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tắt kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UserRoleSeeder::class);
        $this->call(UserUnitSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(DocumentLegalTypeSeeder::class);
        $this->call(DocumentScientificPublicationTypeSeeder::class);

        // Bật lại kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
