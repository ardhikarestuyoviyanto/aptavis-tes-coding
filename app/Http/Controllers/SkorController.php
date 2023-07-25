<?php

namespace App\Http\Controllers;

use App\Models\Klub;
use App\Models\Skor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkorController extends Controller
{
    public function index()
    {
        $data = [
            'skor' => Skor::orderBy('created_at', "DESC")->get()
        ];
        // Variabel menu dikirim ke master.blade.php untuk keperluan navigasi
        // untuk mengaktifkan class "active" pada navbar
        return \view('skor.index', $data)->with('menu', "SkorMenu");
    }

    public function createSingle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'klub_1' => 'required|different:klub_2|unique:skor,klub_1,NULL,id,klub_2,' . $request->klub_2,
            'klub_2' => 'required|different:klub_1|unique:skor,klub_2,NULL,id,klub_1,' . $request->klub_1,
            'skor_klub_1' => 'required|numeric',
            'skor_klub_2' => 'required|numeric'
        ], [
            'klub_1.required' => 'Pilih KLUB 1 terlebih dahulu',
            'klub_2.required' => 'Pilih KLUB 2 terlebih dahulu',
            'skor_klub_1.required' => 'Inputan skor KLUB 1 wajib diisi',
            'skor_klub_2.required' => "Inputan skor KLUB 2 wajib diisi",
            'klub_1.different' => 'KLUB 1 dan KLUB 2 harus berbeda',
            'klub_2.different' => 'KLUB 2 dan KLUB 1 harus berbeda',
            'klub_1.unique' => 'KLUB 1 sudah dipilih oleh pertandingan lain',
            'klub_2.unique' => 'KLUB 2 sudah dipilih oleh pertandingan lain',
        ]);

        if ($validator->fails()) {
            return \redirect()->to('skor?type=SINGLE')->withErrors($validator->errors())->withInput($request->all());
        }

        Skor::create([
            'klub_1' => $request->klub_1,
            'klub_2' => $request->klub_2,
            'skor_klub_1' => $request->skor_klub_1,
            'skor_klub_2' => $request->skor_klub_2
        ]);

        return \redirect()->to('skor?type=SINGLE')->with('success', "Data skor pertandingan berhasil disimpan");
    }

    public function createMultiple(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'klub_1' => 'required|array',
            'klub_1.*' => 'required|exists:klub,id',
            'klub_2' => 'required|array',
            'klub_2.*' => 'required|exists:klub,id',
            'skor_klub_1' => 'required|array',
            'skor_klub_1.*' => 'required|numeric',
            'skor_klub_2' => 'required|array',
            'skor_klub_2.*' => 'required|numeric',
        ], [
            'klub_1.required' => 'Pilih KLUB 1 terlebih dahulu',
            'klub_1.*.required' => 'Pilih KLUB 1 terlebih dahulu',
            'klub_1.*.exists' => 'Klub 1 tidak valid',
            'klub_2.required' => 'Pilih KLUB 2 terlebih dahulu',
            'klub_2.*.required' => 'Pilih KLUB 2 terlebih dahulu',
            'klub_2.*.exists' => 'Klub 2 tidak valid',
            'skor_klub_1.required' => 'Inputan skor KLUB 1 wajib diisi',
            'skor_klub_1.*.required' => 'Inputan skor KLUB 1 wajib diisi',
            'skor_klub_1.*.numeric' => 'Inputan skor KLUB 1 harus berupa angka',
            'skor_klub_2.required' => 'Inputan skor KLUB 2 wajib diisi',
            'skor_klub_2.*.required' => 'Inputan skor KLUB 2 wajib diisi',
            'skor_klub_2.*.numeric' => 'Inputan skor KLUB 2 harus berupa angka',
        ]);

        if ($validator->fails()) {
            return redirect()->to('skor?type=MUTIPLE')->withErrors($validator->errors())->withInput($request->all());
        }

        foreach ($request->klub_1 as $i => $klub_1) {
            // Cek jika ada inputan yang sama dalam satu inputan maka tidak boleh
            if ($klub_1 == $request->klub_2[$i]) {
                return redirect()->to('skor?type=MUTIPLE')->withInput($request->all())->with('error', "Ada nama klub yang sama dalam satu pertandingan");
            }

            // Cek tidak boleh ada data pertandingan yang sama
            if (Skor::where('klub_1', $klub_1)->where('klub_2', $request->klub_2[$i])->first() != null) {
                return redirect()->to('skor?type=MUTIPLE')->withInput($request->all())->with('error', "Ada pertandingan yang duplikat, silahkan cek kembali");
            }
        }

        foreach ($request->klub_1 as $i => $klub_1) {
            Skor::create([
                'klub_1' => $klub_1,
                'klub_2' => $request->klub_2[$i],
                'skor_klub_1' => $request->skor_klub_1[$i],
                'skor_klub_2' => $request->skor_klub_2[$i]
            ]);
        }

        return redirect()->to('skor?type=MUTIPLE')->with('success', count($request->klub_1) . ' Data skor pertandingan berhasil disimpan');
    }

    public function delete(Request $request)
    {
        Skor::where('id', $request->id)->delete();
        return redirect()->to('skor?type=' . $request->segment(4));
    }
}
