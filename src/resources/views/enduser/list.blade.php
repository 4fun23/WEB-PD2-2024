@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if (count($items) > 0)

        <table class="table table-striped table-hover table-sm">
             <thead class="thead-light">
                 <tr>
                    <th>ID</td>
                    <th>Vārds</td>
                    <th>&nbsp;</td>
                </tr>
            </thead>
         <tbody>

    @foreach($items as $enduser)
    <tr>
        <td>{{ $enduser->id }}</td>
        <td>{{ $enduser->name }}</td>
        <td> <a href="/endusers/update/{{ $enduser->id }}" class="btn btn-outline-primary btnsm">Labot</a> 
        <form action="/endusers/delete/{{ $enduser->id }}" method="post" class="deletion-form d-inline">
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

    <a href="/endusers/create" class="btn btn-primary">Izveidot jaunu</a>

@endsection