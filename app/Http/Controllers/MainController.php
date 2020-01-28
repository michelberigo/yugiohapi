<?php

namespace App\Http\Controllers;

use EloquentBuilder;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index (Request $request) {
        //dd($request->all());
        $dados = $request->all();

        foreach ($dados as $key => $dado) {
            if ($dado == null) {
                unset($dados[$key]);
            }
        }

        dump($dados);

        //$url = "https://db.ygoprodeck.com/api/v6/cardinfo.php?{$request->getQueryString()}";
        $url = "https://db.ygoprodeck.com/api/v6/cardinfo.php";
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $cards = json_decode(curl_exec($ch));
        $cards = collect($cards)->take(2);

        $archetypes = $this->archetypes();

        $parametros = [
            'cards' => $cards,
            'archetypes' => $archetypes
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
}
