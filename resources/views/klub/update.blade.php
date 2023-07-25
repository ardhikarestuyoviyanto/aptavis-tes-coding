@extends('master')
@section('title', 'Update Klub')
@section('content')
    <div class="bg-light p-1 mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ms-auto mt-2 mr-5" aria-current="page">
                    <a href="{{ url('klub') }}">Data Klub</a>
                </li>
                <li class="breadcrumb-item mt-2 mr-5 active" aria-current="page" style="margin-right: 10px;">
                    Update Klub
                </li>

            </ol>
        </nav>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-primary">
            <div class="card-text text-white">
                FORM UPDATE DATA KLUB
            </div>
        </div>

        <form action="{{ url('klub/update/' . $data?->id) }}" method="POST">
            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_klub" class="form-label">Nama Klub</label>
                    <input type="text" class="form-control @error('nama_klub') is-invalid @enderror" id="nama_klub"
                        name="nama_klub" placeholder="Masukkan Nama Klub" value="{{ $data?->nama_klub }}">
                    @error('nama_klub')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kota_klub" class="form-label">Kota Klub</label>
                    <input type="text" class="form-control @error('kota_klub') is-invalid @enderror" id="kota_klub"
                        name="kota_klub" placeholder="Masukkan Kota Klub" value="{{ $data?->kota_klub }}">
                    @error('kota_klub')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
