@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Daftar Pencipta Buku</h2>
            <a href="{{ route('bookcreators.create') }}" class="btn btn-primary">Tambah Penulis Buku</a>
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
        <!-- Tampilkan daftar pencipta buku dalam tabel -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($creators as $index => $creator)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $creator->name }}</td>
                        <td>
                            <div class="d-flex">
                               <!-- Tombol Edit -->
                                <a href="{{ route('bookcreators.edit', $creator->id) }}" class="btn btn-primary me-2">Edit</a>
                                
                                <!-- Tombol Hapus (contoh) -->
                                <form action="{{ route('bookcreators.destroy', $creator->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pencipta buku ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
