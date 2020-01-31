<?php

namespace App\Http\Controllers;

use App\CardType;
use EloquentBuilder;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index (Request $request) {
        $data = $request->all();

        $url = "https://db.ygoprodeck.com/api/v6/cardinfo.php?" . http_build_query($data);
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $cards = json_decode(curl_exec($ch));
        $cards = collect($cards);

        $archetypes = $this->archetypes();
        $cardTypes = CardType::all();
        $attributes = collect(['Dark', 'Earth', 'Fire', 'Light', 'Water', 'Wind', 'Divine']);

        $parametros = [
            'cards' => $cards,
            'cardTypes' => $cardTypes,
            'archetypes' => $archetypes,
            'attributes' => $attributes
        ];

        return view('main.index', $parametros);
    }

    protected function archetypes () {
        $url = "https://db.ygoprodeck.com/api/v6/archetypes.php"; 
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $archetypes = json_decode(curl_exec($ch));
        $archetypes = collect($archetypes);

        return $archetypes;
    }

    public function getCardSpecificTypes ($id) {
        return CardType::findOrFail($id)->cardSpecificTypes()->get();
    }

    public function getTypes ($id) {
        return CardType::findOrFail($id)->types()->get();
    }
}
