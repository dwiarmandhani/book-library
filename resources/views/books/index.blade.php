@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Daftar Buku</h2>
            <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku</a>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if(session('failed'))
        <div class="alert alert-success">
            {{ session('failed') }}
        </div>
        @endif
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Cover</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>
                            @if ($book->image)
                                <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" style="max-width: 100px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->description }}</td>
                       
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary me-2">Edit</a>
                                <form action="{{ route('books.destroy', ['book' => $book->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
