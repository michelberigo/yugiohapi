<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CardTypesTableSeeder::class);
        $this->call(CardSpecificTypesTableSeeder::class);
        $this->call(TypesTableSeeder::class);
    }
}
