@extends('master')
@section('title', 'Klasemen')
@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <table class="table table-bordered  table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10px;">No</th>
                        <th scope="col">Klub</th>
                        <th scope="col">Main</th>
                        <th scope="col">Menang</th>
                        <th scope="col">Seri</th>
                        <th scope="col">Kalah</th>
                        <th scope="col">GM</th>
                        <th scope="col">GK</th>
                        <th scope="col">Point</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($result as $i=>$v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $v['namaKlub'] }}</td>
                            <td>{{ $v['totalMain'] }}</td>
                            <td>{{ $v['totalMenang'] }}</td>
                            <td>{{ $v['totalSeri'] }}</td>
                            <td>{{ $v['totalKalah'] }}</td>
                            <td>{{ $v['totalGoalMenang'] }}</td>
                            <td>{{ $v['totalGoalKalah'] }}</td>
                            <td>{{ $v['poinTotal'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Data Klasemen tidak ada :)</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <small>
                GM = Goal Menang (total Gol yg dicetak tim tersebut) <br>
                GK = Goal Kalah (total yg dicetak tim lawan terhadap team tersebut) <br>
                Jika menang + 3 point <br>
                Jika seri masing-masing + 1 point <br>
                JIka kalah + 0 point <br>
            </small>
        </div>
    </div>

    <div class="text-center text-small mt-5">
        Ardhika Restu Yoviyanto - {{ date('Y') }} <br>
        Build By <br>
        <img src="https://mazer.dev/en/laravel/b1-course/laravel-framework-what-is/featured-laravel-logo.png"
            class="img-fluid" width="300" alt="">
    </div>

@endsection
