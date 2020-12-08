@extends('welcome')

@section('head')
    <script type="text/javascript" src="/js/index.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main/main.scss">
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/infinite-scroll/infinite-scroll.css">
@endsection

@section('content')
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <form id="form_search" method="get" action="/">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Tipo da Carta</label>

                        <select name="card-type" id="card-type" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($cardTypes as $cardType)
                                <option value="{{ $cardType->id }}">{{ $cardType->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group card-type-display">
                        <label for="type">Tipo Específico da Carta</label>

                        <select name="type" id="type" class="form-control"></select>
                    </div>

                    <div class="form-group card-type-display">
                        <label for="race">Tipo</label>

                        <select name="race" id="race" class="form-control"></select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fname">Nome</label>

                        <input type="text" name="fname" id="fname" placeholder="Nome" class="form-control">
                    </div>

                    <div class="form-group monster-display">
                        <label for="attribute">Atributo</label>

                        <select name="attribute" id="attribute" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute }}">{{ $attribute }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group monster-display" id="level-display">
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

                    <div class="col-md-12 monster-display">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="atk">ATK</label>

                                    <input type="text" name="atk" id="atk" placeholder="ATK" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" id="def-display">
                                    <label for="def">DEF</label>

                                    <input type="text" name="def" id="def" placeholder="DEF" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center monster-display link-display">
                        <label for="set">Setas Link</label>

                        <div class="mb-2">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-light btn-linkmarker">
                                    <input type="checkbox" class="linkmarker" name="linkmarker[]" value="Top-Left"> <i class="fas fa-arrow-up fa-rotate-45-left"></i>
                                </label>

                                <label class="btn btn-light btn-linkmarker">
                                    <input type="checkbox" class="linkmarker" name="linkmarker[]" value="Top"> <i class="fas fa-arrow-up"></i>
                                </label>

                                <label class="btn btn-light btn-linkmarker">
                                    <input type="checkbox" class="linkmarker" name="linkmarker[]" value="Top-Right"> <i class="fas fa-arrow-up fa-rotate-45-right"></i>
                                </label>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-light btn-linkmarker mr-5">
                                    <input type="checkbox" class="linkmarker" name="linkmarker[]" value="Left"> <i class="fas fa-arrow-left"></i>
                                </label>

                                <label class="btn btn-light btn-linkmarker">
                                    <input type="checkbox" class="linkmarker" name="linkmarker[]" value="Right"> <i class="fas fa-arrow-right"></i>
                                </label>
                            </div>
                        </div>

                        <div>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-light btn-linkmarker">
                                    <input type="checkbox" class="linkmarker" name="linkmarker[]" value="Bottom-Left"> <i class="fas fa-arrow-down fa-rotate-45-right"></i>
                                </label>

                                <label class="btn btn-light btn-linkmarker hidden">
                                    <input type="checkbox" class="linkmarker" name="linkmarker[]" value="Bottom"> <i class="fas fa-arrow-down"></i>
                                </label>

                                <label class="btn btn-light btn-linkmarker">
                                    <input type="checkbox" class="linkmarker" name="linkmarker[]" value="Bottom-Right"> <i class="fas fa-arrow-down fa-rotate-45-left"></i>
                                </label>
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

                    <div class="form-group monster-display link-display">
                        <label for="link">Quantidade Setas Link</label>

                        <select name="link" id="link" class="form-control">
                            <option value="">Selecionar</option>

                            @for ($i = 1; $i < 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group monster-display pendulum-display">
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
        <form action="" id="form_filter" class="form-inline mb-4">
            <label class="m-2 mr-2">Filtrar por:</label>

            <label for="banlist" class="m-1">Banlist</label>

            <select name="banlist" id="banlist" class="form-control m-1 mr-2">
                {!! $banlist !!}
            </select>

            <label for="staple" class="m-1">Staple</label>

            <select name="staple" id="staple" class="form-control m-1">
                <option value="">Não</option>
                <option value="yes" {{ isset($parametros['staple']) ? 'selected' : '' }}>Sim</option>
            </select>

            <label for="sort" class="m-1 ml-5">Ordenar por:</label>

            <select name="sort" id="sort" class="form-control m-1">
                {!! $ordenamento !!}
            </select>
        </form>

        <div class="scroll card-result">
            @foreach ($cards->chunk(4) as $cardsChunk)
                <div class="row text-center">
                    @foreach ($cardsChunk as $card)
                        <div class="col-md-3">
                            <h4>{{ $card['name'] }}</h4>
                            
                            <div class="col-md-12">
                                <a href="" data-toggle="modal" data-target="#ModalImage{{ $card['id'] }}" class="img-above">
                                    @if (isset($card['banlist_info']))
                                        @if (!isset($parametros['banlist']) || $parametros['banlist'] == 'TCG')
                                            @if (isset($card['banlist_info']['ban_tcg']))
                                                @if ($card['banlist_info']['ban_tcg'] == 'Banned')
                                                    <img src="img/banned.png" alt="banned" class="img-responsive img-banlist" title="Atualmente, esta carta está banida!">
                                                @elseif ($card['banlist_info']['ban_tcg'] == 'Limited')
                                                    <img src="img/limited.png" alt="limited" class="img-responsive img-banlist" title="Atualmente, esta carta está limitada!">
                                                @elseif ($card['banlist_info']['ban_tcg'] == 'Semi-Limited')
                                                    <img src="img/semi-limited.png" alt="semi limited" class="img-responsive img-banlist" title="Atualmente, esta carta está semi-limitada!">
                                                @endif
                                            @endif
                                        @else
                                            @if (isset($card['banlist_info']['ban_ocg']))
                                                @if ($card['banlist_info']['ban_ocg'] == 'Banned')
                                                    <img src="img/banned.png" alt="banned" class="img-responsive img-banlist" title="Atualmente, esta carta está banida!">
                                                @elseif ($card['banlist_info']['ban_ocg'] == 'Limited')
                                                    <img src="img/limited.png" alt="limited" class="img-responsive img-banlist" title="Atualmente, esta carta está limitada!">
                                                @elseif ($card['banlist_info']['ban_ocg'] == 'Semi-Limited')
                                                    <img src="img/semi-limited.png" alt="semi limited" class="img-responsive img-banlist" title="Atualmente, esta carta está semi-limitada!">
                                                @endif
                                            @endif
                                        @endif
                                    @endif

                                    <img src="{{ $card['card_images'][0]['image_url_small'] }}" alt="{{ $card['name'] }}" width="168" height="246">
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
                                                        <a href="{{ $card['card_images'][0]['image_url'] }}" target="_blank" title="Clique na carta para poder abri-la em uma nova guia">
                                                            <img src="{{ $card['card_images'][0]['image_url'] }}" class="img-responsive-modal">
                                                        </a>

                                                        <a href="{{ route('cartas.show', $card['id']) }}" class="btn btn-info mt-3" target="_blank">Mais informações da carta</a>
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

                <br>
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