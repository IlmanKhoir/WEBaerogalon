@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Harga Galon</h4>
        </div>
        <div class="card-body">
            <!-- Alert jika ada error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Tambah -->
            <form action="{{ route('edit-harga-galon.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_paket">Nama Paket</label>
                    <input type="text" name="nama_paket" id="nama_paket" class="form-control" placeholder="Masukkan nama paket" required>
                </div>

                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="Masukkan harga" required>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Masukkan deskripsi" required></textarea>
                </div>

                <div class="form-group">
                    <label for="benefit">Benefit (Pisahkan dengan koma)</label>
                    <input type="text" name="benefit" id="benefit" class="form-control" placeholder="Contoh: Air Minum Premium, Pengiriman Cepat, Galon Higienis" required>
                </div>

                <div class="form-group text-right">
                    <a href="{{ route('edit-harga-galon.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection