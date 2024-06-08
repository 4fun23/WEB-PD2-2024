@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif


    <form method="post" action="{{ $enduser->exists ? '/endusers/patch/' . $enduser->id : '/endusers/put'}}">
        @csrf

        <div class="mb-3">
            <label for="enduser-name" class="form-label">Lietotāja vārds</label>

            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="enduser-name"
                name="name"
                value="{{ old('name', $enduser->name) }}"
                >

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">{{ $enduser->exists? 'Rediģēt' : 'Pievienot'}}</button>
    </form>

@endsection