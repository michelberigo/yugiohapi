<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
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
            ['id' => 1, 'type' => 'Aqua', 'card_type_id' => 1],
            ['id' => 2, 'type' => 'Beast', 'card_type_id' => 1],
            ['id' => 3, 'type' => 'Beast-Warrior', 'card_type_id' => 1],
            ['id' => 4, 'type' => 'Creator-God', 'card_type_id' => 1],
            ['id' => 5, 'type' => 'Cyberse', 'card_type_id' => 1],
            ['id' => 6, 'type' => 'Dinosaur', 'card_type_id' => 1],
            ['id' => 7, 'type' => 'Divine-Beast', 'card_type_id' => 1],
            ['id' => 8, 'type' => 'Dragon', 'card_type_id' => 1],
            ['id' => 9, 'type' => 'Fairy', 'card_type_id' => 1],
            ['id' => 10, 'type' => 'Fiend', 'card_type_id' => 1],
            ['id' => 11, 'type' => 'Fish', 'card_type_id' => 1],
            ['id' => 12, 'type' => 'Insect', 'card_type_id' => 1],
            ['id' => 13, 'type' => 'Machine', 'card_type_id' => 1],
            ['id' => 14, 'type' => 'Plant', 'card_type_id' => 1],
            ['id' => 15, 'type' => 'Psychic', 'card_type_id' => 1],
            ['id' => 16, 'type' => 'Pyro', 'card_type_id' => 1],
            ['id' => 17, 'type' => 'Reptile', 'card_type_id' => 1],
            ['id' => 18, 'type' => 'Rock', 'card_type_id' => 1],
            ['id' => 19, 'type' => 'Sea Serpent', 'card_type_id' => 1],
            ['id' => 20, 'type' => 'Spellcaster', 'card_type_id' => 1],
            ['id' => 21, 'type' => 'Thunder', 'card_type_id' => 1],
            ['id' => 22, 'type' => 'Warrior', 'card_type_id' => 1],
            ['id' => 23, 'type' => 'Winged Beast', 'card_type_id' => 1],

            //SPELL
            ['id' => 24, 'type' => 'Normal', 'card_type_id' => 2],
            ['id' => 25, 'type' => 'Field', 'card_type_id' => 2],
            ['id' => 26, 'type' => 'Equip', 'card_type_id' => 2],
            ['id' => 27, 'type' => 'Continuous', 'card_type_id' => 2],
            ['id' => 28, 'type' => 'Quick-Play', 'card_type_id' => 2],
            ['id' => 29, 'type' => 'Ritual', 'card_type_id' => 2],

            //TRAP
            ['id' => 30,'type' => 'Normal', 'card_type_id' => 3],
            ['id' => 31,'type' => 'Continuous', 'card_type_id' => 3],
            ['id' => 32,'type' => 'Counter', 'card_type_id' => 3],
        ];

        foreach ($cards as $card) {
            Type::updateOrCreate(
                [
                    'id' => $card['id']
                ],
                [
                    'id' => $card['id'],
                    'type' => $card['type'],
                    'card_type_id' => $card['card_type_id']
                ]
            );
        }
    }
}
