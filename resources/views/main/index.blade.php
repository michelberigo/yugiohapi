@extends('welcome')

@section('head')
    <script src="js/main.js" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="filter">
            <div>
                <label for="archetype">Archetype</label>

                <select name="archetype" id="archetype">
                    <option value="">Selecionar</option>

                    @foreach ($archetypes as $archetype)
                        <option value="{{ $archetype->archetype_name }}">{{ $archetype->archetype_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="name">Name</label>

                <input type="text" name="name" id="name" placeholder="Name">
            </div>

            <button type="button" class="btn btn-primary" id="search">Buscar</button>
        </form>

        <div class="row">
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