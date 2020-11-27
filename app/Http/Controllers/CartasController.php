<?php

namespace App\Http\Controllers;

use App\CardType;
use App\Repositories\CartaRepository;
use Carbon\Carbon;
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
        $parametrosUrl = [
            'id' => $id,
            'misc' => 'yes'
        ];

        $url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?" . http_build_query($parametrosUrl);
        $response = Http::get($url);

        $carta = $response->json();
        $carta = collect($carta['data'])->first();

        $carta['misc_info'][0]['tcg_date'] = Carbon::parse($carta['misc_info'][0]['tcg_date'])->format('d/m/Y');

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
