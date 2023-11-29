@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ubah Password</h2>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
                

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
