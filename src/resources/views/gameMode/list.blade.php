@extends('layout')
@section('content')
<h1>{{ $title }}</h1>
@if (count($items) > 0)
    <table class="table table-sm table-hover table-striped">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Nosaukums</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $gameMode)
                <tr>
                    <td>{{ $gameMode->id }}</td>
                    <td>{{ $gameMode->name }}</td>  
                    <td>
                        <a href="/gameModes/update/{{ $gameMode->id }}" class="btn btn-outline-primary btn-sm">Labot</a> /
                        <form method="post" action="/gameModes/delete/{{ $gameMode->id }}" class="d-inline deletion-form">
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
<a href="/gameModes/create" class="btn btn-primary">Pievienot jaunu</a>
@endsection