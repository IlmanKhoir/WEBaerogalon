@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pegawai</h1>   
    <form method="POST" action="{{ route('datapegawai.update', $pegawai->id) }}">
        @csrf
        @method('PUT')  
        <div class="form-group">
            <label for="nama">Employe Name</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pegawai->nama }}" required>
        </div>
        <div class="form-group">
            <label for="no_hp">Phone Number</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $pegawai->no_hp }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection