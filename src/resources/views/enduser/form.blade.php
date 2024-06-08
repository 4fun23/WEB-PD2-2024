@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif


    <form method="post" action="/endusers/put">
        @csrf

        <div class="mb-3">
            <label for="enduser-name" class="form-label">Lietotāja vārds</label>

            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="enduser-name"
                name="name">

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">Pievienot</button>
    </form>
    
@endsection