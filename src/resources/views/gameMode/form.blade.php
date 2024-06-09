@extends('layout')
@section('content')
<h1>{{ $title }}</h1>
@if ($errors->any())
    <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
@endif
<form method="post" action="{{ $gameMode->exists ? '/gameModes/patch/' . $gameMode->id : '/gameModes/put' }}">
    @csrf
    <div class="mb-3">
        <label for="gameMode-name" class="form-label">Spēles režīma nosaukums</label>
        <input type="text" id="gameMode-name" name="name" value="{{ old('name', $gameMode->name) }}"
            class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <p class="invalid-feedback">{{ $errors->first('name') }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="gameMode-character" class="form-label">Profils</label>
        <select 
            id="gameMode-character"
            name="character_id"
            class="form-select @error('character_id') is-invalid @enderror">
            <option value="">Norādiet profilu!</option>
            @foreach($characters as $character)
                <option value="{{ $character->id }}" 
                @if ($character->id == old('character_id', $gameMode->character->id ?? false)) selected @endif>{{ $character->username }}</option>
            @endforeach
        </select>
        @error('character_id')
            <p class="invalid-feedback">{{ $errors->first('character_id') }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        {{ $gameMode->exists ? 'Atjaunot ierakstu' : 'Pievienot ierakstu' }}
    </button>
</form>
@endsection