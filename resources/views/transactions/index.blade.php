@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Transactions</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTransactionModal">
                    Add Transaction
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- Table Jumlah Halaman -->
                <div class="mb-3">
                    <label>Tampilkan</label>
                    <select class="form-control-sm" id="per-page">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label>data per halaman</label>
                    
                    <div class="float-right">
                        <label>Cari:</label>
                        <input type="search" class="form-control-sm" id="search">
                    </div>
                </div>

                <!-- Table Data transaksi -->
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Galon Out</th>
                            <th>Galon In</th>
                            <th>Transaction Date</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $index => $transaction)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $transaction->customer_name }}</td>
                            <td>{{ $transaction->galon_out }}</td>
                            <td>{{ $transaction->galon_in }}</td>
                            <td>{{ date('d-m-Y', strtotime($transaction->transaction_date)) }}</td>
                            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-info edit-btn" data-id="{{ $transaction->id }}">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $transaction->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Next dan Previous -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        Menampilkan {{ $transactions->firstItem() ?? 0 }} sampai {{ $transactions->lastItem() ?? 0 }} 
                        dari total {{ $transactions->total() }} data
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end mb-0">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $transactions->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $transactions->previousPageUrl() }}" tabindex="-1">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </a>
                            </li>
                            
                            <!-- Pagination Elements -->
                            @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                                <li class="page-item {{ $transactions->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            
                            <!-- Next Page Link -->
                            <li class="page-item {{ !$transactions->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $transactions->nextPageUrl() }}">
                                    Next <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <a href="{{ route('expenses.index') }}" class="btn btn-info btn-ml ml-3">
                <i class="fas fa-money-bill-wave"></i> Lihat Pengeluaran
            </a>
            <a href="{{ route('transactions.export.pdf') }}" class="btn btn-danger btn-ml mr-3">Export PDF</a>
        </div>
    </div>
</div>

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Transaction</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="addTransactionForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Customer</label>
                        <select name="customer_id" class="form-control" required>
                            <option value="">Pilih Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Galon In</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons" id="galonInOptions">
                            @for ($i = 1; $i <= 5; $i++)
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="galon_in_option" value="{{ $i }}"> {{ $i }}
                            </label>
                            @endfor
                            <label class="btn btn-outline-secondary">
                                <input type="radio" name="galon_in_option" value="other"> Lainnya
                            </label>
                        </div>
                        <input type="number" name="galon_in" class="form-control mt-2" placeholder="Masukkan jumlah galon" style="display: none;">
                    </div>

                    <div class="form-group">
                        <label>Galon Out</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons" id="galonOutOptions">
                            @for ($i = 1; $i <= 5; $i++)
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="galon_out_option" value="{{ $i }}"> {{ $i }}
                            </label>
                            @endfor
                            <label class="btn btn-outline-secondary">
                                <input type="radio" name="galon_out_option" value="other"> Lainnya
                            </label>
                        </div>
                        <input type="number" name="galon_out" class="form-control mt-2" placeholder="Masukkan jumlah galon" style="display: none;">
                    </div>

                    <div class="form-group">
                        <label>Transaction Date</label>
                        <input type="date" name="transaction_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Total Price</label>
                        <input type="number" name="total_price" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Transaction Modal -->
<div class="modal fade" id="editTransactionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Transaction</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editTransactionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" name="customer_name" class="form-control mt-2" placeholder="Isi nama customer" oninput="updateCustomerSelect(this.value)">
                        <select name="customer_id" class="form-control mt-2" required>
                            <option value="">Pilih Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <script>
                        function updateCustomerSelect(inputValue) {
                            const selectElement = document.querySelector('select[name="customer_id"]');
                            const options = selectElement.options;
                            for (let i = 0; i < options.length; i++) {
                                if (options[i].text.toLowerCase().includes(inputValue.toLowerCase())) {
                                    selectElement.selectedIndex = i;
                                    break;
                                }
                            }
                        }
                    </script>
                    <div class="form-group">
                        <label>Galon Out</label>
                        <input type="number" name="galon_out" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Galon In</label>
                        <input type="number" name="galon_in" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Transaction Date</label>
                        <input type="date" name="transaction_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Total Price</label>
                        <input type="number" name="total_price" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Script untuk menampilkan data transaksi
$(document).ready(function() {
    // Event handler untuk pencarian
    $('#search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Event handler untuk jumlah data per halaman
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
    // Script untuk menampilkan jumlah data per halaman
    $('#per-page').val("{{ $perPage }}");

    // Event handler untuk tombol Add
    $('#addTransactionForm').on('submit', function(e) {
        e.preventDefault();
        
        // Script untuk menambahkan data transaksi
        $.ajax({
            url: "{{ route('transactions.store') }}",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    $('#addTransactionModal').modal('hide');
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Transaksi berhasil ditambahkan!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            },
            //notifikasi kesalahan
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Terjadi kesalahan! ' + xhr.responseText);
            }
        });
    });

    // Galon In Logic
    $('input[name="galon_in_option"]').on('change', function() {
        if ($(this).val() === 'other') {
            $('input[name="galon_in"]').show().attr('required', true);
            $('input[name="galon_in"]').val(''); // Clear value when switching to manual input
        } else {
            $('input[name="galon_in"]').hide().removeAttr('required');
            $('input[name="galon_in"]').val($(this).val()); // Sync selected value to input
        }
    });

        // Galon Out Logic
        $('input[name="galon_out_option"]').on('change', function() {
        if ($(this).val() === 'other') {
            $('input[name="galon_out"]').show().attr('required', true);
            $('input[name="galon_out"]').val(''); // Clear value when switching to manual input
        } else {
            $('input[name="galon_out"]').hide().removeAttr('required');
            $('input[name="galon_out"]').val($(this).val()); // Sync selected value to input
        }
    });
    
    // Event handler untuk tombol Edit
    $('.edit-btn').on('click', function() {
        var id = $(this).data('id');
        var url = '/transactions/' + id + '/edit';
        
        // Reset form
        $('#editTransactionForm')[0].reset();
        
        // Ambil data transaksi
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                // Isi form dengan data yang ada
                $('#editTransactionForm').attr('action', '/transactions/' + id);
                $('#editTransactionForm select[name="customer_id"]').val(response.customer_id);
                $('#editTransactionForm input[name="galon_out"]').val(response.galon_out);
                $('#editTransactionForm input[name="galon_in"]').val(response.galon_in);
                $('#editTransactionForm input[name="transaction_date"]').val(response.transaction_date);
                $('#editTransactionForm input[name="total_price"]').val(response.total_price);
                
                // Tampilkan modal
                $('#editTransactionModal').modal('show');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengambil data!'
                });
            }
        });
    });

    // Event handler untuk form edit
    $('#editTransactionForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if(response.success) {
                    $('#editTransactionModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data transaksi berhasil diperbarui',
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
                    text: 'Terjadi kesalahan saat memperbarui data!'
                });
            }
        });
    });

    // Event handler untuk tombol Delete
    $('.delete-btn').on('click', function() {
        if(confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
            var id = $(this).data('id');
            
            $.ajax({
                url: "/transactions/" + id,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) {
                        alert('Transaksi berhasil dihapus!');
                        window.location.reload();
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        }
    });

});
</script>

@endsection
