<!-- resources/views/books/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Buku</h2>
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" value="{{ $book->title }}" required>
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control  @error('description') is-invalid @enderror" id="description" name="description">{{ $book->description }}</textarea>
                @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control  @error('image') is-invalid @enderror" id="image" name="image">
                @if ($errors->has('image'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
            </div>
            <div class="mb-3">
                <label for="book_creator_id" class="form-label">Pencipta Buku</label>
                <select class="form-select  @error('book_creator_id') is-invalid @enderror" id="book_creator_id" name="book_creator_id" required>
                    @foreach($creators as $creator)
                        <option value="{{ $creator->id }}" @if($creator->id === $book->book_creator_id) selected @endif>{{ $creator->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('book_creator_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('book_creator_id') }}</strong>
                </span>
            @endif
            </div>
            <!-- tambahkan input fields untuk data lainnya -->
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
