@extends('welcome')

@section('head')
    <script src="js/main.js" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="filter" method="get" action="/">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="archetype">Archetype</label>

                        <select name="archetype" id="archetype" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($archetypes as $archetype)
                                <option value="{{ $archetype->archetype_name }}">{{ $archetype->archetype_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fname">Name</label>

                        <input type="text" name="fname" id="fname" placeholder="Name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="banlist">Banlist</label>

                        <select name="banlist" id="banlist" class="form-control">
                            <option value="">Nenhum</option>
                            <option value="tcg">TCG</option>
                            <option value="ocg">OCG</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Card Type</label>

                        <select name="" id="card-type" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($cardTypes as $cardType)
                                <option value="{{ $cardType->id }}">{{ $cardType->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group hide-card-type">
                        <label for="type">Card Specific Type</label>

                        <select name="type" id="type" class="form-control">
                        </select>
                    </div>

                    <div class="form-group hide-card-type">
                        <label for="race">Type</label>

                        <select name="race" id="race" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($cardTypes as $cardType)
                                <option value="{{ $cardType->id }}">{{ $cardType->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group hide-card-type">
                        <label for="attribute">Attribute</label>

                        <select name="attribute" id="attribute" class="form-control">
                            <option value="">Selecionar</option>

                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute }}">{{ $attribute }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group hide-card-type">
                        <label for="level">Level</label>

                        <select name="level" id="level" class="form-control">
                            <option value="">Selecionar</option>

                            @for ($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-12 hide-card-type">
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
                    <div class="form-group hide-card-type">
                        <label for="link">Link</label>

                        <select name="link" id="link" class="form-control">
                            <option value="">Selecionar</option>

                            @for ($i = 1; $i < 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group hide-card-type">
                        <label for="scale">Scale</label>

                        <select name="scale" id="scale" class="form-control">
                            <option value="">Selecionar</option>

                            @for ($i = 0; $i < 14; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary" id="search">Buscar</button>
                </div>
            </div>
        </form>

        <div class="row text-center">
            @foreach ($cards as $card)
                <div class="col-md-4">
                    <h4>{{ $card->name }}</h4>
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ $card->card_images[0]->image_url_small }}" alt="">
                            </div>

                            <div class="col-md-6">
                                <p>Card Set Information</p>

                                @if (!empty($card->card_sets))
                                    @foreach ($card->card_sets as $set)
                                        <div><small>{{ $set->set_name }}</small></div>
                                        <div><small>{{ $set->set_rarity }}</small></div>
                                        <div><small>{{ $set->set_price }}</small></div>

                                        <br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection