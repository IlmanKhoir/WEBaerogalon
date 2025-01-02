@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Absensi Pegawai</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAbsensiModal">
                    Tambah Absensi
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Filter -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <span>Tampilkan</span>
                        <select class="form-control form-control-sm mx-2" id="per-page" style="width: auto;">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span>data</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari nama pegawai...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal</th>
                            <th>Waktu Absen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensi as $index => $a)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $a->nama }}</td>
                            <td>{{ date('d/m/Y', strtotime($a->tanggal)) }}</td>
                            <td>{{ date('H:i:s', strtotime($a->created_at)) }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $a->id }}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Di bagian bawah tabel -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    Menampilkan {{ $from }} sampai {{ $to }} dari {{ $totalData }} data
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        {{-- Previous Page Link --}}
                        <li class="page-item {{ $absensi->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $absensi->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        {{-- Pagination Elements --}}
                        @foreach ($absensi->getUrlRange(1, $absensi->lastPage()) as $page => $url)
                            <li class="page-item {{ $absensi->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        <li class="page-item {{ !$absensi->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $absensi->nextPageUrl() }}" aria-label="Next">
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

<!-- Modal Add Absensi -->
<div class="modal fade" id="addAbsensiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Absensi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="addAbsensiForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pegawai</label>
                        <select name="pegawai_id" class="form-control" required>
                            <option value="">Pilih Pegawai</option>
                            @foreach($pegawai as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required 
                               value="{{ date('Y-m-d') }}">
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
$(document).on('click', '.btn-delete', function() {
    let absensiId = $(this).data('id'); // Ambil ID absensi

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data absensi akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/absensi/${absensiId}`, // Route delete
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Sedang memproses data',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        ).then(() => {
                            window.location.reload(); // Refresh halaman
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire(
                        'Gagal!',
                        xhr.responseJSON.message || 'Terjadi kesalahan!',
                        'error'
                    );
                }
            });
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Event handler untuk form tambah absensi
    $('#addAbsensiForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: "{{ route('absensi.store') }}",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Sedang memproses data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            },
            success: function(response) {
                if(response.success) {
                    $('#addAbsensiModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: xhr.responseJSON.message || 'Terjadi kesalahan!'
                });
            }
        });
    });

    // Event handler untuk filter
    $('#btn-filter').click(function() {
        $.ajax({
            url: "{{ route('absensi.filter') }}",
            type: "GET",
            data: {
                pegawai_id: $('#filter-pegawai').val(),
                tanggal_mulai: $('#filter-tanggal-mulai').val(),
                tanggal_akhir: $('#filter-tanggal-akhir').val()
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Sedang memproses data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            },
            success: function(response) {
                Swal.close();
                // Update table dengan data yang difilter
                updateTable(response);
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memfilter data!'
                });
            }
        });
    });

    // Reset filter
    $('#btn-reset').click(function() {
        $('#filter-pegawai').val('');
        $('#filter-tanggal-mulai').val('');
        $('#filter-tanggal-akhir').val('');
        $('#btn-filter').click();
    });

    // Fungsi untuk update table
    function updateTable(data) {
        var tbody = $('table tbody');
        tbody.empty();
        
        data.forEach(function(item, index) {
            var row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.nama}</td>
                    <td>${formatDate(item.tanggal)}</td>
                    <td>${formatDateTime(item.created_at)}</td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Format tanggal
    function formatDate(date) {
        return new Date(date).toLocaleDateString('id-ID');
    }

    // Format tanggal dan waktu
    function formatDateTime(datetime) {
        return new Date(datetime).toLocaleString('id-ID');
    }

    // Event handler untuk perubahan jumlah data per halaman
    $('#per-page').on('change', function() {
        let perPage = $(this).val();
        let currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('per_page', perPage);
        currentUrl.searchParams.set('page', 1); // Reset ke halaman pertama
        
        // Tampilkan loading
        Swal.fire({
            title: 'Loading...',
            text: 'Sedang memuat data',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
        
        window.location.href = currentUrl.toString();
    });

    // Event handler untuk pencarian
    let searchTimer;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            let searchValue = $(this).val();
            let currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('search', searchValue);
            currentUrl.searchParams.set('page', 1); // Reset ke halaman pertama
            
            // Tampilkan loading
            Swal.fire({
                title: 'Mencari...',
                text: 'Sedang mencari data',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            
            window.location.href = currentUrl.toString();
        }, 500); // Delay 500ms untuk mengurangi request
    });
});
</script>
<script>
        // Mencegah pengguna menekan tombol back
        (function (global) {
            if (typeof (global) === "undefined") {
                throw new Error("window is undefined");
            }

            var _hash = "!";
            var noBackPlease = function () {
                global.location.href += "#";

                // Menambahkan hash ke URL
                global.setTimeout(function () {
                    global.location.href += "!";
                }, 50);
            };

            global.onhashchange = function () {
                if (global.location.hash !== _hash) {
                    global.location.hash = _hash;
                }
            };

            global.onload = function () {
                noBackPlease();

                // Menonaktifkan tombol back
                document.body.onkeydown = function (e) {
                    var elm = e.target.nodeName.toLowerCase();
                    if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
                        e.preventDefault();
                    }
                    // Mencegah tombol backspace
                    e.stopPropagation();
                };
            };
        })(window);
    </script>
@endsection