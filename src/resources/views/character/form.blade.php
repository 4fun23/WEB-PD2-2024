@extends('layout')
@section('content')
<h1>{{ $title }}</h1>
@if ($errors->any())
    <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
@endif
<form method="post" action="{{ $character->exists ? '/characters/patch/' . $character->id : '/characters/put' }}"
    enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="character-username" class="form-label">Varoņa vārds</label>
        <input type="text" id="character-username" name="username" value="{{ old('username', $character->username) }}"
            class="form-control @error('username') is-invalid @enderror">
        @error('username')
            <p class="invalid-feedback">{{ $errors->first('username') }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="character-enduser" class="form-label">Lietotājs</label>
        <select id="character-enduser" name="enduser_id" class="form-select @error('enduser_id') is-invalid @enderror">
            <option value="">Norādiet lietotāju!</option>
            @foreach($endusers as $enduser)
                <option value="{{ $enduser->id }}" @if ($enduser->id == old('enduser_id', $character->enduser->id ?? false))
                selected @endif>{{ $enduser->name }}</option>
            @endforeach
        </select>
        @error('enduser_id')
            <p class="invalid-feedback">{{ $errors->first('enduser_id') }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="character-bio" class="form-label">Bio</label>
        <textarea id="character-bio" name="bio"
            class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $character->bio) }}</textarea>
        @error('bio')
            <p class="invalid-feedback">{{ $errors->first('bio') }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="character-questPoints" class="form-label">Kvestu punktu skaits</label>
        <input type="number" id="character-questPoints" name="questPoints"
            value="{{ old('questPoints', $character->questPoints) }}"
            class="form-control @error('questPoints') is-invalid @enderror">
        @error('questPoints')
            <p class="invalid-feedback">{{ $errors->first('questPoints') }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="character-totalLevel" class="form-label">Kopējais prasmju līmenis</label>
        <input type="number" id="character-totalLevel" name="totalLevel"
            value="{{ old('totalLevel', $character->totalLevel) }}"
            class="form-control @error('totalLevel') is-invalid @enderror">
        @error('totalLevel')
            <p class="invalid-feedback">{{ $errors->first('totalLevel') }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="character-image" class="form-label">Attēls</label>
        @if ($character->image)
            <img src="{{ asset('images/' . $character->image) }}" class="img-fluid img-thumbnail d-block mb-2"
                alt="{{ $character->username }}">
        @endif
        <input type="file" accept="image/png, image/jpeg, image/webp" id="character-image" name="image"
            class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <p class="invalid-feedback">{{ $errors->first('image') }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="character-collectionLogSlots" class="form-label">Kolekciju priekšmetu skaits</label>
        <input type="number" id="character-collectionLogSlots" name="collectionLogSlots"
            value="{{ old('collectionLogSlots', $character->collectionLogSlots) }}"
            class="form-control @error('collectionLogSlots') is-invalid @enderror">
        @error('collectionLogSlots')
            <p class="invalid-feedback">{{ $errors->first('collectionLogSlots') }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        {{ $character->exists ? 'Atjaunot ierakstu' : 'Pievienot ierakstu' }}
    </button>
</form>
@endsection