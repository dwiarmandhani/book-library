@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Informasi Penulis Buku</h2>
        
        <form action="{{ route('bookcreators.update', $creator->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ $creator->name }}">
            <!-- tambahkan input fields untuk data yang akan diubah -->
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
