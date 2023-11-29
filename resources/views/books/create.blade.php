<!-- resources/views/books/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Buku Baru</h2>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="book_creator_id" class="form-label">Pencipta Buku</label>
                <select class="form-select" id="book_creator_id" name="book_creator_id" required>
                    @foreach($creators as $creator)
                        <option value="{{ $creator->id }}">{{ $creator->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- tambahkan input fields untuk data lainnya -->
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
