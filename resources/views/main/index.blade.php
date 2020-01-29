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
                </div>

                <div class="col-md-3">
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary" id="search">Buscar</button>
                </div>
            </div>
        </form>

        <div class="row text-center">
            @foreach ($cards as $card)
                <div class="col-md-4">
                    {{ $card->name }}

                    <div>
                        <img src="{{ $card->card_images[0]->image_url_small }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection