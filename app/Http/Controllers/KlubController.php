<?php

namespace App\Http\Controllers;

use App\Models\Klub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KlubController extends Controller
{
    public function index()
    {
        $data = [
            'data' => Klub::orderBy('nama_klub', "ASC")->paginate(10)
        ];

        // Variabel menu dikirim ke master.blade.php untuk keperluan navigasi
        // untuk mengaktifkan class "active" pada navbar
        return \view('klub.index', $data)->with('menu', "KlubMenu");
    }

    public function createView()
    {
        return \view('klub.create')->with('menu', "KlubMenu");
    }

    public function create(Request $request)
    {
        // Nama klub tidak boleh ada yang kembar
        $validator = Validator::make($request->all(), [
            'nama_klub' => 'required|unique:klub',
            'kota_klub' => 'required'
        ], [
            'nama_klub.required' => 'Inputan nama klub wajib diisi',
            'nama_klub.unique' => 'Nama klub ' . $request->nama_klub . ' sudah anda inputkan sebelumnya.',
            'kota_klub.required' => 'Inputan kota klub wajib diisi'
        ]);

        if ($validator->fails()) {
            return \redirect()->to('klub/create')->withErrors($validator->errors())->withInput($request->all());
        }

        Klub::create([
            'nama_klub' => $request->nama_klub,
            'kota_klub' => $request->kota_klub
        ]);

        return \redirect()->to('klub/create')->with('success', "Data klub berhasil disimpan");
    }

    public function updateView(Request $request)
    {
        $data = [
            'data' => Klub::find($request->segment(3))
        ];
        return \view('klub.update', $data)->with('menu', "KlubMenu");
    }

    public function update(Request $request)
    {
        // Nama klub tidak boleh ada yang kembar
        // segmen(3) id nya
        $validator = Validator::make($request->all(), [
            'nama_klub' => 'required|unique:klub,nama_klub,' . $request->segment(3),
            'kota_klub' => 'required'
        ], [
            'nama_klub.required' => 'Inputan nama klub wajib diisi',
            'nama_klub.unique' => 'Nama klub ' . $request->nama_klub . ' sudah anda inputkan sebelumnya.',
            'kota_klub.required' => 'Inputan kota klub wajib diisi'
        ]);

        if ($validator->fails()) {
            return \redirect()->to('klub/update/' . $request->segment(3))->withErrors($validator->errors())->withInput($request->all());
        }

        Klub::where('id', $request->segment(3))->update([
            'nama_klub' => $request->nama_klub,
            'kota_klub' => $request->kota_klub
        ]);

        return \redirect()->to('klub/update/' . $request->id)->with('success', "Data klub berhasil diupdate");
    }

    public function delete(Request $request)
    {
        Klub::where('id', $request->segment(3))->delete();
        return \redirect()->to('klub')->with('success', "Data klub berhasil dihapus");
    }
}
