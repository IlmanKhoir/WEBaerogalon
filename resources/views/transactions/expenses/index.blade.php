{{-- Start of Selection --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Pengeluaran</h1>
    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addExpenseModal">Tambah Pengeluaran</a>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <label>Tampilkan</label>
                    <select class="form-control form-control-sm" id="per-page">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <label>data per halaman</label>
                </div>
            </div>

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $expense->description }}</td>
                        <td>Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                        <td>{{ date('d-m-Y', strtotime($expense->date)) }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $expense->id }}">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    Menampilkan {{ $expenses->firstItem() ?? 0 }} sampai {{ $expenses->lastItem() ?? 0 }} 
                    dari total {{ $expenses->total() }} data
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        {{-- Previous Page Link --}}
                        <li class="page-item {{ $expenses->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $expenses->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        {{-- Pagination Elements --}}
                        @foreach ($expenses->getUrlRange(1, $expenses->lastPage()) as $page => $url)
                            <li class="page-item {{ $expenses->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        <li class="page-item {{ !$expenses->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $expenses->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengeluaran -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#per-page').on('change', function() {
        let perPage = $(this).val();
        let currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('per_page', perPage);
        currentUrl.searchParams.set('page', 1); // Reset ke halaman pertama
        
        window.location.href = currentUrl.toString();
    });

    $('.delete-btn').on('click', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pengeluaran ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/expenses/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Terhapus!',
                                'Pengeluaran berhasil dihapus.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>


@endsection
{{-- End of Selection --}}