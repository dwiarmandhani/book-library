@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Penulis Buku Baru</h2>
        <form method="POST" action="{{ route('bookcreators.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Penulis</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>

            <!-- Tambahkan field lain jika diperlukan -->

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
