<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UserRoleSeeder::class);
        $this->call(UserUnitSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(DocumentTypeSeeder::class);
        $this->call(DocumentLegalTypeSeeder::class);
        $this->call(DocumentScientificPublicationTypeSeeder::class);
        $this->call(DocumentBiodiversityTypeSeeder::class);

        $this->call(DocumentSeeder::class);
        $this->call(DocumentLegalSeeder::class);
        $this->call(DocumentScientificPublicationSeeder::class);

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

        $this->call(MapLayerTypeSeeder::class);
        $this->call(MapLayerSeeder::class);


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
