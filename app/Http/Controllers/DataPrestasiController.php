<?php

namespace App\Http\Controllers;

use App\Models\DataPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class DataPrestasiController extends Controller
{
    //
    public function index() {
        $dataPrestasi = DataPrestasi::all();
        return view('database.prestasi.index', compact('dataPrestasi'));
    }
    public function create() {
        return view('database.prestasi.add');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'status' => 'required|in:Guru,Siswa',
            'tanggal_lomba' => 'required|date',
            'tempat_lomba' => 'required|string',
            'peringkat' => 'required|string|max:20',
            'path_sertifikat' => 'required',
        ]);

        // Get the uploaded file

    $file = $request->file('path_sertifikat');
    $namaFile = 'Dokumentasi-' . str_replace(' ', '_', $request->nama) . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('/files/prestasi/' . $request->status . '/'), $namaFile);
    // Create a new DataPrestasi record with file path
    $dataPrestasi = DataPrestasi::create(array_merge($validatedData, [
        'nama_file' => '/files/prestasi/' . $request->status . '/' .$namaFile
    ]));

    return redirect()->route('prestasi.index')->with('success', 'Data berhasil dihapus');

    }
    public function edit($id) {
        $prestasi = DataPrestasi::findOrFail($id);
        return view('database.prestasi.edit', compact('prestasi'));
    }
}
