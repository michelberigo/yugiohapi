<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\CardType;

class CardTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cards = [
            ['type' => 'Monster'],
            ['type' => 'Spell'],
            ['type' => 'Trap']
        ];

        foreach ($cards as $card) {
            CardType::updateOrCreate(
                ['type' => $card['type']],
                ['type' => $card['type']]
            );
        }
    }
}
