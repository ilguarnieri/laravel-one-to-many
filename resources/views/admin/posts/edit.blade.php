@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="container">
        <div class="row">
            <div class="col-10">
                
                <h1>Modifica post: <span class="text-primary">{{ $post->title }}</span></h1>
            </div>
            <div class="col-2">
                
                <form class="delete-form" action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                
                    <button class="btn btn-small btn-danger" type="submit">
                      Elimina
                    </button>
                  </form>
                </form> 
            </div>
        </div>
    </div>
    
    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- TITOLO --}}
        <div class="form-group">
          <label for="title">Titolo*</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') ?: $post->title }}">

          @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- COVER --}}
        <div class="form-group">
            <label for="cover">URL immagine</label>
            <input type="url" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" value="{{ old('cover') ?: $post->cover }}">
  
            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- CONTENUTO --}}
        <div class="form-group">
            <label for="content">Contenuto articolo*</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4">{{ old('content') ?: $post->content }}</textarea>

            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- DATA --}}
        <div class="form-group">
            <label for="published_at">Data di pubblicazione</label>
            <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at') ?: Str::substr($post->published_at, 0, 10) }}">
  
            @error('published_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <h6>Campi obbligatori*</h6>
        </div>

        {{-- BUTTON --}}
        <button type="submit" class="btn btn-primary">Salva</button>

        <a class="ml-4 text-secondary" href="{{ route('admin.posts.index') }}">
            Torna ai posts
        </a>
</div>
@endsection