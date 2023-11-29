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
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description">{{ $book->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="book_creator_id" class="form-label">Pencipta Buku</label>
                <select class="form-select" id="book_creator_id" name="book_creator_id" required>
                    @foreach($creators as $creator)
                        <option value="{{ $creator->id }}" @if($creator->id === $book->book_creator_id) selected @endif>{{ $creator->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- tambahkan input fields untuk data lainnya -->
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
