@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Informasi Penulis Buku</h2>
        
        <form action="{{ route('bookcreators.update', $creator->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Penulis</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $creator->name }}" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <!-- tambahkan input fields untuk data yang akan diubah -->
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
