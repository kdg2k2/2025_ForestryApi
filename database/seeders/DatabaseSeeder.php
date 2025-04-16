<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserRoleSeeder::class);
        $this->call(UserUnitSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(DocumentLegalTypeSeeder::class);
        $this->call(DocumentScientificPublicationTypeSeeder::class);
    }
}
