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

        $this->call(BioNationalParkTypeSeeder::class);
        $this->call(BioNationalParkSeeder::class);

        $this->call(BioAnimalAlbumImageSeeder::class);
        $this->call(BioAnimalSeeder::class);
        $this->call(BioAnimalNationalParkSeeder::class);
        $this->call(BioAnimalImageSeeder::class);

        $this->call(BioPlantAlbumImageSeeder::class);
        $this->call(BioPlantSeeder::class);
        $this->call(BioPlantImageSeeder::class);
        $this->call(BioPlantNationalParkSeeder::class);

        $this->call(BioExpertSeeder::class);

        $this->call(MapVn2000ProjectionSeeder::class);
    }
}
