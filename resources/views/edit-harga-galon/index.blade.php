@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Daftar Harga Galon</h4>
            <a href="{{ route('edit-harga-galon.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data Galon
            </a>
        </div>
        <div class="card-body">
            <!-- Alert jika ada pesan sukses -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Tabel List Galon -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hargaGalon as $index => $galon)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $galon->nama_paket }}</td>
                            <td>Rp {{ number_format($galon->price, 0, ',', '.') }}</td>
                            <td>{{ $galon->description }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('edit-harga-galon.edit', $galon->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Tombol Delete (Trigger Modal) -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $galon->id }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        <!-- Modal untuk Konfirmasi Hapus -->
                        <div class="modal fade" id="deleteModal{{ $galon->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $galon->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $galon->id }}">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{ $galon->nama_paket }}</strong>? Data ini tidak bisa dikembalikan setelah dihapus.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <form action="{{ route('edit-harga-galon.destroy', $galon->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data galon.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection