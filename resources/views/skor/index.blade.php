@extends('master')
@section('title', 'Input Skor')
@section('content')
    <div class="bg-light p-1 mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ms-auto mt-2 mr-5 active" aria-current="page" style="margin-right: 10px;">
                    Input Skor
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

    <div class="row mb-5">
        <div class="col-sm-4 mt-1">
            {{-- Menu Untuk Memilih Inputan Yang Diberikan Single atau Multiple --}}
            <div class="card mb-3">
                <div class="card-body">
                    <div class="alert alert-info text-small">
                        <small><b>Pilih Tipe Inputan Dahulu (Mutiple atau Single)</b></small>
                    </div>
                    <form action="#" method="get">
                        <select required name="type" class="form-select" id="">
                            <option selected value="">- PILIH TIPE INPUTAN -</option>
                            <option {{ @$_GET['type'] == 'SINGLE' ? 'selected' : '' }} value="SINGLE">
                                - INPUTAN SINGLE -
                            </option>
                            <option {{ @$_GET['type'] == 'MUTIPLE' ? 'selected' : '' }} value="MUTIPLE">
                                - INPUTAN MUTIPLE -
                            </option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
            <div class="card">
                {{-- Start Form Input Single --}}
                @if (@$_GET['type'] == 'SINGLE')
                    <x-form-input-skor-single />
                @endif
                {{-- End Form Input Single --}}

                {{-- Start Form Input Mutiple --}}
                @if (@$_GET['type'] == 'MUTIPLE')
                    <x-form-input-skor-mutiple />
                @endif
                {{-- End Form Input Mutiple --}}
            </div>
        </div>
        <div class="col-sm-8 mt-1">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">No</th>
                                <th scope="col" style="text-align: center">KLUB A</th>
                                <th scope="col" style="width: 10px;"></th>
                                <th scope="col" style="text-align: center">KLUB B</th>
                                <th scope="col" style="width: 20px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($skor as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        {{ \App\Models\Klub::where('id', $s->klub_1)->first()?->nama_klub }} <br>
                                        <b>{{ $s->skor_klub_1 }}</b>
                                    </td>
                                    <td class="text-center">VS</td>
                                    <td class="text-center">
                                        {{ \App\Models\Klub::where('id', $s->klub_2)->first()?->nama_klub }} <br>
                                        <b>{{ $s->skor_klub_2 }}</b>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url(request()->get('type') == null ? 'skor/delete/' . $s->id . '/' . 'SINGLE' : 'skor/delete/' . $s->id . '/' . request()->get('type')) }}"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data klub ini ?')">
                                            <span class="badge bg-danger">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data skor gak ada :)</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
