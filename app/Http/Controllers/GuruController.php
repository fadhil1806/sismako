<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\IjazahGuru;
use App\Models\SertifikatGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

    public function fileSetup($file, $nama, $prefix, $dir, $path = '') {
        $imageFileName = $prefix . str_replace(' ', '_', $nama) . '.' . $file->getClientOriginalExtension();
        $fullPath = public_path('img/guru/' . $dir . $path);

        // Pastikan direktori tujuan ada
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        $file->move($fullPath, $imageFileName);

        return $imageFileName;
    }

    public function store(Request $request) {
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
            'foto' => 'required|image',
            'foto_ktp' => 'required|image',
            'foto_surat_keterangan_mengajar' => 'required|image',
            'ijazah_smp' => 'required|image',
            'ijazah_sma' => 'required|image'
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
            'foto.required' => 'Foto wajib diisi',
            'foto_ktp.required' => 'Foto KTP wajib diisi',
            'foto_surat_keterangan_mengajar.required' => 'Foto surat keterangan mengajar wajib diisi',
            'ijazah_smp.required' => 'Foto Ijazah SMP wajib diisi',
            'ijazah_sma.required' => 'Foto Ijazah SMA wajib diisi',
        ]);

        $nama = $request->nama;
        $namaDir = str_replace(' ', '_', $nama);
        $baseDir = public_path('img/guru/' . $namaDir);

        if (!file_exists($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        $ijazahDir = $baseDir . '/ijazah';
        if (!file_exists($ijazahDir)) {
            mkdir($ijazahDir, 0777, true);
        }

        $sertifikatDir = $baseDir . '/sertifikat';
        if (!file_exists($sertifikatDir)) {
            mkdir($sertifikatDir, 0777, true);
        }

        $imageNamaFoto = null;
        $imageNamaFotoKtp = null;
        $imageNamaFotoSk = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageNamaFoto = $this->fileSetup($file, $nama, 'Foto-', $namaDir);
        }

        if ($request->hasFile('foto_ktp')) {
            $file = $request->file('foto_ktp');
            $imageNamaFotoKtp = $this->fileSetup($file, $nama, 'Foto-KTP-', $namaDir);
        }

        if ($request->hasFile('foto_surat_keterangan_mengajar')) {
            $file = $request->file('foto_surat_keterangan_mengajar');
            $imageNamaFotoSk = $this->fileSetup($file, $nama, 'Foto-SK-Mengajar-', $namaDir);
        }

        $guru = Guru::create([
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
            'foto' => $imageNamaFoto,
            'foto_ktp'=> $imageNamaFotoKtp,
            'foto_surat_keterangan_mengajar' => $imageNamaFotoSk
        ]);

        $idGuru = $guru->id;
        $pathDirIjazah = public_path('img/' . $namaDir . '/ijazah');
        $ijazahData = [];

        if ($request->hasFile('ijazah_smp')) {
            $file = $request->file('ijazah_smp');
            $imageNamaFotoIjazahSmp = $this->fileSetup($file, $nama, 'Foto-Ijazah-SMP-', $namaDir, '/ijazah');
            $ijazahData[] = ['id_guru' => $idGuru, 'jenis_ijazah' => 'SMP', 'nama_file' => $imageNamaFotoIjazahSmp];
        }
        if ($request->hasFile('ijazah_sma')) {
            $file = $request->file('ijazah_sma');
            $imageNamaFotoIjazahSma = $this->fileSetup($file, $nama, 'Foto-Ijazah-SMA-', $namaDir, '/ijazah');
            $ijazahData[] = ['id_guru' => $idGuru, 'jenis_ijazah' => 'SMA', 'nama_file' => $imageNamaFotoIjazahSma];
        }
        if ($request->hasFile('ijazah_s1')) {
            $file = $request->file('ijazah_s1');
            $imageNamaFotoIjazahS1 = $this->fileSetup($file, $nama, 'Foto-Ijazah-S1-', $namaDir, '/ijazah');
            $ijazahData[] = ['id_guru' => $idGuru, 'jenis_ijazah' => 'S1', 'nama_file' => $imageNamaFotoIjazahS1];
        }
        if ($request->hasFile('ijazah_s2')) {
            $file = $request->file('ijazah_s2');
            $imageNamaFotoIjazahS2 = $this->fileSetup($file, $nama, 'Foto-Ijazah-S2-', $namaDir, '/ijazah');
            $ijazahData[] = ['id_guru' => $idGuru, 'jenis_ijazah' => 'S2', 'nama_file' => $imageNamaFotoIjazahS2];
        }

        if (!empty($ijazahData)) {
            IjazahGuru::insert($ijazahData);
        }

        return redirect()->route('guru.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id) {
        $data = Guru::findOrFail($id);
        $namaDir = str_replace(' ', '_', $data->nama);

        // Path direktori
        $baseDir = public_path('img/guru/' . $namaDir);

        // Hapus direktori dan semua isinya
        if (File::exists($baseDir)) {
            File::deleteDirectory($baseDir);
        }

        // Hapus data dari database
        $data->delete();

        return redirect()->route('guru.index')->with('success', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('database.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id) {
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
            'foto' => 'required|image',
            'foto_ktp' => 'required|image',
            'foto_surat_keterangan_mengajar' => 'required|image',
            'ijazah_smp' => 'required|image',
            'ijazah_sma' => 'required|image'
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
            'foto.required' => 'Foto wajib diisi',
            'foto_ktp.required' => 'Foto KTP wajib diisi',
            'foto_surat_keterangan_mengajar.required' => 'Foto surat keterangan mengajar wajib diisi',
            'ijazah_smp.required' => 'Foto Ijazah SMP wajib diisi',
            'ijazah_sma.required' => 'Foto Ijazah SMA wajib diisi',
        ]);
    }

}
