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
        $parametros = $this->carta->ajustarParametros($request->all());

        $parametrosUrl = http_build_query($parametros);
        $url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?" . $parametrosUrl;

        $response = Http::get($url);

        $cartas = $response->json();
        
        if (isset($cartas['error'])) {
            return redirect()->route('cartas.index')->with('error', 'Sem resultados encontrados!');
        }

        $cartas = collect($cartas['data']);

        if (!isset($parametros['sort'])) {
            $cartas = $cartas->sortBy('name');
        }

        $cartas = $this->carta->paginarCollection($cartas, $request->get('page'));

        $archetypes = $this->carta->getArchetypes();
        $cardSets = $this->carta->getCardSets();
        $attributes = $this->carta->getAttributes();

        $banlist = $this->carta->getBanlist();
        $banlist = gerarSelect($banlist, isset($parametros['banlist']) ? $parametros['banlist'] : null);

        $ordenamento = $this->carta->getOrdenamento();
        $ordenamento = gerarSelect($ordenamento, isset($parametros['sort']) ? $parametros['sort'] : null);

        $cardTypes = CardType::all();

        $parametros = [
            'cards' => $cartas,
            'cardTypes' => $cardTypes,
            'archetypes' => $archetypes,
            'attributes' => $attributes,
            'banlist' => $banlist,
            'ordenamento' => $ordenamento,
            'cardSets' => $cardSets,
            'parametros' => $parametros
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
