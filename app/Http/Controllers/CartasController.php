<?php

namespace App\Http\Controllers;

use App\CardType;
use App\Repositories\CartaRepository;
//use EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartasController extends Controller
{
    private $carta;

    public function __construct(CartaRepository $carta)
    {
        $this->carta = $carta;
    }
    
    public function index(Request $request)
    {
        $dados = $this->carta->ajustarParametros($request->all());

        $parametrosUrl = http_build_query($dados);
        $url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?" . $parametrosUrl;

        $response = Http::get($url);

        $cartas = $response->json();
        $cartas = collect($cartas['data']);
        $cartas = $cartas->sortBy('name');

        $cartas = $this->carta->paginarCollection($cartas, $request->get('page'));

        $archetypes = $this->carta->getArchetypes();
        $cardSets = $this->carta->getCardSets();
        $attributes = $this->carta->getAttributes();

        $cardTypes = CardType::all();

        $parametros = [
            'cards' => $cartas,
            'cardTypes' => $cardTypes,
            'archetypes' => $archetypes,
            'attributes' => $attributes,
            'cardSets' => $cardSets
        ];

        return view('cartas.index', $parametros);
    }

    public function show($id)
    {
        $url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?id=" . $id;
        $response = Http::get($url);

        $carta = $response->json();
        $carta = collect($carta['data'])->first();

        $parametros = [
            'carta' => $carta
        ];

        return view('cartas.show', $parametros);
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
