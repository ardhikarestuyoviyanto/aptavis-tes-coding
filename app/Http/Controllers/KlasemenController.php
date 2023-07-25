<?php

namespace App\Http\Controllers;

use App\Models\Klub;
use App\Models\Skor;
use Illuminate\Http\Request;

class KlasemenController extends Controller
{
    public function index()
    {
        $result = array();

        foreach (Klub::all() as $k) {
            $klasemen = Skor::hasilKlasemen($k->id);

            $result[] = [
                'namaKlub' => $k->nama_klub,
                'totalMain' => $klasemen['totalMain'],
                'totalMenang' => $klasemen['totalMenang'],
                'totalKalah' => $klasemen['totalKalah'],
                'totalSeri' => $klasemen['totalSeri'],
                'totalGoalKalah' => $klasemen['totalGoalKalah'],
                'totalGoalMenang' => $klasemen['totalGoalMenang'],
                'poinTotal' => $klasemen['poinTotal']
            ];
        }

        $data = [
            // sort descending
            'result' => Skor::sortKlasemenByPoinTotal($result)
        ];

        // Variabel menu dikirim ke master.blade.php untuk keperluan navigasi
        // untuk mengaktifkan class "active" pada navbar
        return \view('klasemen.index', $data)->with('menu', "KlasemenMenu");
    }
}
