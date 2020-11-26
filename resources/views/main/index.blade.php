@extends('welcome')

@section('head')
    <script src="js/main.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/main/main.scss">
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/infinite-scroll/infinite-scroll.css">
@endsection

@section('content')
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <form id="filter" method="get" action="/">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Tipo da Carta</label>

                        <select name="" id="card-type" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($cardTypes as $cardType)
                                <option value="{{ $cardType->id }}">{{ $cardType->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group hide-card-type">
                        <label for="type">Tipo Específico da Carta</label>

                        <select name="type" id="type" class="form-control"></select>
                    </div>

                    <div class="form-group hide-card-type">
                        <label for="race">Tipo</label>

                        <select name="race" id="race" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($cardTypes as $cardType)
                                <option value="{{ $cardType->id }}">{{ $cardType->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fname">Nome</label>

                        <input type="text" name="fname" id="fname" placeholder="Nome" class="form-control">
                    </div>

                    <div class="form-group hide-monster">
                        <label for="attribute">Atributo</label>

                        <select name="attribute" id="attribute" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute }}">{{ $attribute }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group hide-monster">
                        <label for="level">Nível/Rank</label>

                        <select name="level" id="level" class="form-control">
                            <option value="">Selecionar</option>

                            @for ($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="archetype">Arquétipo</label>

                        <select name="archetype" id="archetype" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($archetypes as $archetype)
                                <option value="{{ $archetype['archetype_name'] }}">{{ $archetype['archetype_name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 hide-monster">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="atk">ATK</label>

                                    <input type="text" name="atk" id="atk" placeholder="ATK" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="def">DEF</label>

                                    <input type="text" name="def" id="def" placeholder="DEF" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="set">Sets</label>

                        <select name="set" id="set" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($cardSets as $cardSet)
                                <option value="{{ $cardSet['set_name'] }}">{{ $cardSet['set_name'] }} - {{ $cardSet['set_code'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group hide-monster">
                        <label for="link">Setas Link</label>

                        <select name="link" id="link" class="form-control">
                            <option value="">Selecionar</option>

                            @for ($i = 1; $i < 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group hide-monster">
                        <label for="scale">Escala Pendulum</label>

                        <select name="scale" id="scale" class="form-control">
                            <option value="">Selecionar</option>

                            @for ($i = 0; $i < 14; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success" id="search">Buscar</button>
                </div>
            </div>
        </form>
    </nav>

    <br>

    <div class="container-fluid">
        <div class="row text-center scroll">
            @foreach ($cards as $card)
                <div class="col-md-3 card-result">
                    <h4>{{ $card['name'] }}</h4>
                    
                    <div class="col-md-12">
                        <a href="" data-toggle="modal" data-target="#ModalImage{{ $card['id'] }}">
                            <img src="{{ $card['card_images'][0]['image_url_small'] }}" alt="{{ $card['name'] }}" width="168" height="246">

                            @if (isset($card['banlist_info']['ban_tcg']))
                                @if ($card['banlist_info']['ban_tcg'] == 'Banned')
                                    <img src="img/banned.png" alt="banned" class="img-banlist">
                                @elseif ($card['banlist_info']['ban_tcg'] == 'Limited')
                                    <img src="img/limited.png" alt="limited" class="img-banlist">
                                @elseif ($card['banlist_info']['ban_tcg'] == 'Semi-Limited')
                                    <img src="img/semi-limited.png" alt="semi limited" class="img-banlist">
                                @endif
                            @endif
                        </a>

                        <!-- Modal -->
                        <div id="ModalImage{{ $card['id'] }}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ $card['name'] }}</h4>
                                        
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{ $card['card_images'][0]['image_url'] }}" class="img-responsive-modal ">
                                            </div>

                                            <div class="col-md-6">
                                                @if (isset($card['card_sets']))
                                                    @foreach ($card['card_sets'] as $set)
                                                        <h4>Set: {{ $set['set_name'] }}</h4>
                                                        <h5>Raridade: {{ $set['set_rarity'] }}</h5>

                                                        <br>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="scroller-status">
            <div class="loader-ellips infinite-scroll-request">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div>
            
            <p class="scroller-status__message infinite-scroll-last">Fim</p>
            <p class="scroller-status__message infinite-scroll-error">No more pages to load</p>
        </div>

        {{ $cards->appends($_GET)->links() }}
    </div>
@endsection