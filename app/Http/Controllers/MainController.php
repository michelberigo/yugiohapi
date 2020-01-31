<?php

namespace App\Http\Controllers;

use App\CardType;
use EloquentBuilder;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index (Request $request) {
        $data = $request->all();

        $page = 1;
        if (array_key_exists('page', $data)) {
            $page = $data['page'];

            unset($data['page']);
        }

        $url = "https://db.ygoprodeck.com/api/v6/cardinfo.php?" . http_build_query($data);
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $cards = json_decode(curl_exec($ch));
        $cards = collect($cards)->sortBy('type');
        $cards = $this->pagination($cards, $page);

        $archetypes = $this->archetypes();
        $cardSets = $this->cardSets();
        $cardTypes = CardType::all();
        $attributes = collect(['Dark', 'Earth', 'Fire', 'Light', 'Water', 'Wind', 'Divine']);

        $parametros = [
            'cards' => $cards,
            'cardTypes' => $cardTypes,
            'archetypes' => $archetypes,
            'attributes' => $attributes,
            'cardSets' => $cardSets
        ];

        return view('main.index', $parametros);
    }

    public function pagination ($cards, $page) {
        $perPage = 12;

        $cards = new \Illuminate\Pagination\LengthAwarePaginator(
            $cards->forPage($page, $perPage), 
            $cards->count(), 
            $perPage, 
            $page
        );

        return $cards;
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

    protected function cardsets () {
        $url = "https://db.ygoprodeck.com/api/v6/cardsets.php"; 
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $cardSets = json_decode(curl_exec($ch));
        $cardSets = collect($cardSets);

        return $cardSets;
    }

    public function getCardSpecificTypes ($id) {
        return CardType::findOrFail($id)->cardSpecificTypes()->get();
    }

    public function getTypes ($id) {
        return CardType::findOrFail($id)->types()->get();
    }
}
