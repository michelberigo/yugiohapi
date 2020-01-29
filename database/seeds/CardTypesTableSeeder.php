<?php

use Illuminate\Database\Seeder;

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
            App\CardType::updateOrCreate(
                [
                    'type' => $card['type']
                ],
                [
                    'type' => $card['type']
                ]
            );
        }
    }
}
