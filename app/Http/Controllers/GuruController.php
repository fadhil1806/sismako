<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    //
    public function index()
    {
        $guru = Guru::all();
        return view('database.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('database.guru.add');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'no_nik' => 'required',
        'no_gtk' => 'required',
        'no_nuptk' => 'required',
        'tempat_tanggal_lahir' => 'required',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'nama_lulusan_pt' => 'required',
        'nama_jurusan_pt' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required',
        'mapel' => 'required',
        'gelar' => 'required',
        'email' => 'required',
        'no_rekening' => 'required',
        'status_kepegawaian' => 'required',
        'tanggal_masuk' => 'required',
        'tanggal_keluar' => 'required',
    ], [
        'nama.required' => 'Nama wajib diisi',
        'no_nik.required' => 'Nomor NIK wajib diisi',
        'no_gtk.required' => 'Nomor GTK wajib diisi',
        'no_nuptk.required' => 'Nomor NUPTK wajib diisi',
        'tempat_tanggal_lahir.required' => 'Tempat dan tanggal lahir wajib diisi',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
        'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',
        'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
        'agama.required' => 'Agama wajib diisi',
        'nama_lulusan_pt.required' => 'Nama lulusan PT wajib diisi',
        'nama_jurusan_pt.required' => 'Nama jurusan PT wajib diisi',
        'alamat.required' => 'Alamat wajib diisi',
        'no_hp.required' => 'Nomor HP wajib diisi',
        'mapel.required' => 'Mapel wajib diisi',
        'gelar.required' => 'Gelar wajib diisi',
        'email.required' => 'Email wajib diisi',
        'no_rekening.required' => 'Nomor rekening wajib diisi',
        'status_kepegawaian.required' => 'Status kepegawaian wajib diisi',
        'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
    ]);

        $imageFoto = $request->file('foto');
        $imageNamaFoto = 'Foto' . '-' .$request->nama . '.' . $imageFoto->getClientOriginalExtension();
        $imageFoto->move(public_path('img/guru/foto'), $imageNamaFoto);


        $imageFotoKtp = $request->file('foto_ktp');
        $imageNamaFotoKtp = 'Foto-KTP' . '-' .$request->nama . '.' . $imageFotoKtp->getClientOriginalExtension();
        $imageFotoKtp->move(public_path('img/guru/foto/ktp'), $imageNamaFotoKtp);


        $imageFotoSK = $request->file('foto_surat_keterangan_mengajar');
        $imageNamaFotoSK = 'Foto-SK-Mengajar' . '-' .$request->nama . '.' . $imageFotoSK->getClientOriginalExtension();
        $imageFotoSK->move(public_path('img/guru/foto/sk'), $imageNamaFotoSK);

        Guru::create([
            'nama' => $request->nama,
            'no_nik' => $request->no_nik,
            'no_gtk' => $request->no_gtk,
            'no_nuptk' => $request->no_nuptk,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'nama_lulusan_pt' => $request->nama_lulusan_pt,
            'nama_jurusan_pt' => $request->nama_jurusan_pt,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'mapel' => $request->mapel,
            'gelar' => $request->gelar,
            'email' => $request->email,
            'no_rekening' => $request->no_rekening,
            'status_kepegawaian' => $request->status_kepegawaian,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'foto' => 'FOTO-' . $request->nama,
            'foto_ktp'=> '$imageNamaFotoKtp',
            'foto_surat_keterangan_mengajar' => '$imageNamaFotoSK'
        ]);

    return redirect()->route('guru.index')->with('success', 'Data guru berhasil disimpan.');
}

}
