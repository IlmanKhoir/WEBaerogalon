@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Gaji Karyawan</h3>
        <</div>
            <div class="card-body">
                <form method="GET" action="{{ url('/penggajian') }}">
                    <div class="form-row">
                        <div class="col">
                            <input type="date" name="tanggal_mulai" class="form-control" required>
                        </div>
                        <div class="col">
                            <input type="date" name="tanggal_akhir" class="form-control" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-hover mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Total Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gajiPerPegawai as $nama => $totalGaji)
                            <tr>
                                <td>{{ $nama }}</td>
                                <td>Rp {{ number_format($totalGaji, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection