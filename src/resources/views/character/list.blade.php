@extends('layout')

@section('content')

<h1>{{ $title }}</h1>

@if (count($items) > 0)
    <table class="table table-sm table-hover table-striped">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Profils</th>
                <th>Lietotājvārds</th>
                <th>Spēles režīms</th>
                <th>Kvestu punktu skaits</th>
                <th>Kopējais prasmju līmenis</th>
                <th>Kolekciju priekšmetu skaits</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $character)
                <tr>
                    <td>{{ $character->id }}</td>
                    <td>{{ $character->username }}</td>
                    <td>{{ $character->enduser->name }}</td>
                    <td>{{ $character->gameMode->name }}</td>
                    <td>{{ $character->questPoints }}</td>
                    <td>{{ $character->totalLevel}}</td>
                    <td>{{ $character->collectionLogSlots }}</td>
                    <td>
                        <a href="/characters/update/{{ $character->id }}" class="btn btn-outline-primary btn-sm">Labot</a> /
                        <form method="post" action="/characters/delete/{{ $character->id }}" class="d-inline deletion-form">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Dzēst</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Nav atrasts neviens ieraksts</p>
@endif
<a href="/characters/create" class="btn btn-primary">Pievienot jaunu</a>
@endsection