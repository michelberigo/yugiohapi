<?php

use Illuminate\Database\Seeder;

class CardSpecificTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cards = [
            //MONSTER
            ['type' => 'Normal Monster', 'card_type_id' => 1],
            ['type' => 'Normal Tuner Monster', 'card_type_id' => 1],
            ['type' => 'Effect Monster', 'card_type_id' => 1],
            ['type' => 'Flip Effect Monster', 'card_type_id' => 1],
            ['type' => 'Tuner Monster', 'card_type_id' => 1],
            ['type' => 'Flip Tuner Effect Monster', 'card_type_id' => 1],
            ['type' => 'Ritual Monster', 'card_type_id' => 1],
            ['type' => 'Ritual Effect Monster', 'card_type_id' => 1],
            ['type' => 'Toon Monster', 'card_type_id' => 1],
            ['type' => 'Gemini Monster', 'card_type_id' => 1],
            ['type' => 'Spirit Monster', 'card_type_id' => 1],
            ['type' => 'Union Effect Monster', 'card_type_id' => 1],
            ['type' => 'Union Tuner Effect Monster', 'card_type_id' => 1],
            ['type' => 'Pendulum Normal Monster', 'card_type_id' => 1],
            ['type' => 'Pendulum Effect Monster', 'card_type_id' => 1],
            ['type' => 'Pendulum Flip Effect Monster', 'card_type_id' => 1],
            ['type' => 'Pendulum Tuner Effect Monster', 'card_type_id' => 1],
            ['type' => 'Fusion Monster', 'card_type_id' => 1],
            ['type' => 'Pendulum Effect Fusion Monster', 'card_type_id' => 1],
            ['type' => 'Synchro Monster', 'card_type_id' => 1],
            ['type' => 'Synchro Tuner Monster', 'card_type_id' => 1],
            ['type' => 'Synchro Pendulum Effect Monster', 'card_type_id' => 1],
            ['type' => 'XYZ Monster', 'card_type_id' => 1],
            ['type' => 'XYZ Pendulum Effect Monster', 'card_type_id' => 1],
            ['type' => 'Link Monster', 'card_type_id' => 1],

            //SPELL
            ['type' => 'Spell Card', 'card_type_id' => 2],

            //TRAP
            ['type' => 'Trap Card', 'card_type_id' => 3],
        ];

        foreach ($cards as $card) {
            App\CardSpecificType::updateOrCreate(
                [
                    'type' => $card['type']
                ],
                [
                    'card_type_id' => $card['card_type_id']
                ]
            );
        }
    }
}
