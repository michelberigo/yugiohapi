<?php

namespace App\Repositories;

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
}
