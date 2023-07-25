@extends('master')
@section('title', 'Data Klub')
@section('content')
    <div class="bg-light p-1 mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ms-auto mt-2 mr-5 active" aria-current="page" style="margin-right: 10px;">
                    Data Klub
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
        <div class="card-header">
            <a href="{{ url('klub/create') }}" type="button" class="btn btn-primary btn-sm" style="float: right;">
                Tambah
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10px;">No</th>
                        <th scope="col">Nama Klub</th>
                        <th scope="col">Kota</th>
                        <th scope="col" style="width: 90px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d?->nama_klub }}</td>
                            <td>{{ $d?->kota_klub }}</td>
                            <td>
                                <a href="{{ url('klub/update/' . $d->id) }}">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </a>
                                <a href="{{ url('klub/delete/' . $d->id) }}"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data klub ini ?')">
                                    <span class="badge bg-danger">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Data klub tidak ada :)</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>

@endsection
