@extends('layout.main')

@section('content')
<div class="card">
    @if(!empty($game))
        <h5 class="card-header">{{ $game->title }}</h5>
        <div class="card-body">
            <ul>
                <li>Id: {{ $game->id }}</li>
                <li>Nazwa: {{ $game->title }}</li>
                <li>Wydawca: {{ $game->publisher }}</li>
                <li>Kategoria:
                    <div>
                        <span>id: {{ $game->genre->id }}</span>
                        <span>name: {{ $game->genre->name }}</span>
                    </div>
                        </li>
                <li>
                    Opis:
                    <div>{{ $game->description }}</div>
                </li>
            </ul>

            <a href="{{ route('games.e.list') }}" class="btn btn-light">Lista gier</a>
        </div>
    @else
        <h5 class="card-header">Brak danych do wyświetlenia</h5>
    @endif
</div>
@endsection
