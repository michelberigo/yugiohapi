<?php

namespace App\Repositories;

use App\CardType;
use App\Client;
use Illuminate\Support\Facades\Http;

class CartaRepository
{
    public function ajustarParametros($dados)
    {
        if (isset($dados['page'])) {
            unset($dados['page']);
        }

        if (isset($dados['linkmarker'])) {
            $dados['linkmarker'] = collect($dados['linkmarker'])->implode(',');
        }

        if (isset($dados['card-type']) && !isset($dados['type'])) {
            $cardSpecificType = CardType::find($dados['card-type'])->cardSpecificTypes;

            $dados['type'] = $cardSpecificType->implode('type', ',');
        }

        $dados['format'] = 'tcg';

        return $dados;
    }

    public function paginarCollection($cartas, $pagina)
    {
        $porPagina = 32;
        $pagina = $pagina ?? 1;

        $cartas = new \Illuminate\Pagination\LengthAwarePaginator(
            $cartas->forPage($pagina, $porPagina),
            $cartas->count(),
            $porPagina,
            $pagina
        );

        return $cartas;
    }

    public function getArchetypes()
    {
        $url = "https://db.ygoprodeck.com/api/v7/archetypes.php";
        $archetypes = Http::get($url);

        $archetypes = collect($archetypes->json());

        return $archetypes;
    }

    public function getCardsets()
    {
        $url = "https://db.ygoprodeck.com/api/v7/cardsets.php";
        $cardSets = Http::get($url);

        $cardSets = collect($cardSets->json());

        return $cardSets;
    }

    public function getAttributes()
    {
        $attributes = collect(['Dark', 'Earth', 'Fire', 'Light', 'Water', 'Wind', 'Divine']);

        return $attributes;
    }

    public function getBanlist()
    {
        $banlist = collect([
            ['value' => "TCG", 'label' => 'TCG'],
            ['value' => "OCG", 'label' => 'OCG'],
        ]);

        return $banlist;
    }

    public function getOrdenamento()
    {
        $ordenamento = collect([
            ['value' => "atk", 'label' => 'ATK'],
            ['value' => "def", 'label' => 'DEF'],
            ['value' => "name", 'label' => 'Nome'],
            ['value' => "type", 'label' => 'Tipo'],
            ['value' => "level", 'label' => 'Nível'],
            ['value' => "new", 'label' => 'Recente'],
        ]);

        return $ordenamento;
    }
}
