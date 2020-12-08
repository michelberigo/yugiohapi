@extends('welcome')

@section('head')
    <script type="text/javascript" src="/js/show.js"></script>
@endsection

@section('content')
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('cartas.index') }}">Página Inicial</a>
    </nav>

    <div class="container-fluid">
        <input type="hidden" id="cartaId" value="{{ $carta['id'] }}">
        
        <h1 class="text-center mt-5">{{ $carta['name'] }}</h1>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ $carta['card_images'][0]['image_url'] }}" alt="{{ $carta['name'] }}">
            </div>

            <div class="col-md-8">
                <h3 class="text-center">Dados da Carta</h3>

                <p><b>Data de Lançamento TCG:</b> {{ $carta['misc_info'][0]['tcg_date'] }}</p>

                @if(isset($carta['archetype']))
                    <p><b>Arquétipo:</b> {{ $carta['archetype'] }}</p>
                @endif

                @if(isset($carta['attribute']))
                    <p><b>Atributo:</b> {{ $carta['attribute'] }}</p>
                @endif

                @if(isset($carta['level']))
                    <p><b>Nível/Rank:</b> {{ $carta['level'] }}</p>
                @endif

                <p><b>Tipo da Carta:</b> {{ $carta['type'] }}</p>
                <p><b>Tipo:</b> {{ $carta['race'] }}</p>

                @if(isset($carta['def']))
                    <p><b>ATK:</b> {{ $carta['atk'] }}</p>
                @endif

                @if(isset($carta['def']))
                    <p><b>DEF:</b> {{ $carta['def'] }}</p>
                @endif

                @if(isset($carta['scale']))
                    <p><b>Escala Pendulum:</b> {{ $carta['scale'] }}</p>
                @endif

                @if(isset($carta['linkval']))
                    <p><b>Quantidade Setas:</b> {{ $carta['linkval'] }}</p>
                @endif

                <div><b>Texto/Efeito:</b></div>
                <div id="carta_efeito">{!! nl2br($carta['desc']) !!}</div>
                <button id="traduzir_efeito" class="btn btn-info btn-sm mt-2" data-language="pt">Traduzir Efeito</button>

                <hr>

                <h3 class="text-center">Sets</h3>

                @if(isset($carta['card_sets']))
                    @foreach(collect($carta['card_sets'])->chunk(2) as $cardSetChunk)
                        <div class="row">
                            @foreach($cardSetChunk as $cardSet)
                                <div class="col-md-6 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <p><b>Nome:</b> {{ $cardSet['set_name'] }}</p>
                                            <p><b>Código:</b> {{ $cardSet['set_code'] }}</p>
                                            <p><b>Raridade:</b> {{ $cardSet['set_rarity'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <p>Atualmente, esta carta não está vinculada a algum set.</p>
                @endif
            </div>
        </div>
    </div>

    <br>
@endsection