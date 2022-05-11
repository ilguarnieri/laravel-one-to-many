@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        
        {{-- TITOLO --}}
        <div class="form-group">
          <label for="title">Titolo:</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">

          @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- CONTENUTO --}}
        <div class="form-group">
            <label for="content">Contenuto articolo:</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4">{{ old('content') }}</textarea>

            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- COVER --}}
        <div class="form-group">
            <label for="cover">URL immagine:</label>
            <input type="url" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" value="{{ old('cover') }}">
  
            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- DATA --}}
        <div class="form-group">
            <label for="published_at">Data di pubblicazione:</label>
            <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at') }}">
  
            @error('published_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- BUTTON --}}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form> 
</div>

@endsection