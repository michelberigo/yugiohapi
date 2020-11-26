<?php

namespace App\Http\Controllers;

use App\CardType;
use EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $dados = $request->all();
        if (isset($dados['page'])) {
            unset($dados['page']);
        }

        $parametrosUrl = http_build_query($dados);
        $url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?" . $parametrosUrl;

        $response = Http::get($url);

        $cartas = $response->json();
        $cartas = collect($cartas['data']);
        $cartas = $cartas->sortBy('name');

        $cartas = $this->pagination($cartas, $request->get('page'));

        $archetypes = $this->getArchetypes();
        $cardSets = $this->getCardSets();
        $cardTypes = CardType::all();
        $attributes = collect(['Dark', 'Earth', 'Fire', 'Light', 'Water', 'Wind', 'Divine']);

        $parametros = [
            'cards' => $cartas,
            'cardTypes' => $cardTypes,
            'archetypes' => $archetypes,
            'attributes' => $attributes,
            'cardSets' => $cardSets
        ];

        return view('main.index', $parametros);
    }

    public function pagination($cards, $page)
    {
        $perPage = 32;
        $page = $page ?? 1;

        $cards = new \Illuminate\Pagination\LengthAwarePaginator(
            $cards->forPage($page, $perPage),
            $cards->count(),
            $perPage,
            $page
        );

        return $cards;
    }

    protected function getArchetypes()
    {
        $url = "https://db.ygoprodeck.com/api/v7/archetypes.php";
        $archetypes = Http::get($url);

        $archetypes = collect($archetypes->json());

        return $archetypes;
    }

    protected function getCardsets()
    {
        $url = "https://db.ygoprodeck.com/api/v7/cardsets.php";
        $cardSets = Http::get($url);

        $cardSets = collect($cardSets->json());

        return $cardSets;
    }

    public function getCardSpecificTypes($id)
    {
        return CardType::find($id)->cardSpecificTypes;
    }

    public function getTypes($id)
    {
        return CardType::find($id)->types;
    }
}
