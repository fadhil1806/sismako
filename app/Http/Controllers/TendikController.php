<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tendik;

class TendikController extends Controller
{
    public function create() {
        return view('database.tendik.add');
    }
    public function fileSetup($file, $nama, $prefix, $namaDir, $path = '')
    {
        $imageFileName = $prefix . str_replace(' ', '_', $nama) . '.' . $file->getClientOriginalExtension();
        $fullPath = public_path('img/tendik/' . $namaDir . $path);

        // Pastikan direktori tujuan ada
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        $file->move($fullPath, $imageFileName);

        return $imageFileName;
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required|string|max:40',
        //     'no_nik' => 'required|string|max:20|unique:tendik,no_nik',
        //     'no_gtk' => 'required|string|max:20|unique:tendik,no_gtk',
        //     'no_nuptk' => 'required|string|max:20|unique:tendik,no_nuptk',
        //     'tempat_tanggal_lahir' => 'required|string|max:20',
        //     'tanggal_lahir' => 'required|date',
        //     'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        //     'agama' => 'required|in:Islam,Kristen,Buddha,Khonghucu,Hindu,Katolik',
        //     'alamat' => 'required|string',
        //     'status_kepegawaian' => 'required|in:Aktif,Tidak aktif',
        //     'no_rekening' => 'required|string|max:20|unique:tendik,no_rekening',
        //     'posisi_jabatan' => 'required|string|max:40',
        //     'email' => 'required|string|max:30|email|unique:tendik,email',
        //     'pendidikan_terakhir' => 'required|in:Smp,Sma,S1,S2,S3',
        //     'tanggal_masuk' => 'required|date',
        //     'tanggal_keluar' => 'required|date',
        //     'foto' => 'required|image',
        //     'foto_ktp' => 'required|image',
        //     'foto_surat_keterangan_mengajar' => 'required|image',
        //     'ijazah_smp' => 'required|image',
        //     'ijazah_sma' => 'required|image'
        // ], [
        //     // Custom error messages
        //     'nama.required' => 'Nama wajib diisi',
        //     'no_nik.required' => 'Nomor NIK wajib diisi',
        //     'no_gtk.required' => 'Nomor GTK wajib diisi',
        //     'no_nuptk.required' => 'Nomor NUPTK wajib diisi',
        //     'tempat_tanggal_lahir.required' => 'Tempat dan tanggal lahir wajib diisi',
        //     'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
        //     'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',
        //     'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
        //     'agama.required' => 'Agama wajib diisi',
        //     'alamat.required' => 'Alamat wajib diisi',
        //     'status_kepegawaian.required' => 'Status kepegawaian wajib diisi',
        //     'no_rekening.required' => 'Nomor rekening wajib diisi',
        //     'posisi_jabatan.required' => 'Posisi jabatan wajib diisi',
        //     'email.required' => 'Email wajib diisi',
        //     'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib diisi',
        //     'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
        //     'tanggal_keluar.required' => 'Tanggal keluar wajib diisi',
        //     'foto.required' => 'Foto wajib diisi',
        //     'foto_ktp.required' => 'Foto KTP wajib diisi',
        //     'foto_surat_keterangan_mengajar.required' => 'Foto surat keterangan mengajar wajib diisi',
        //     'ijazah_smp.required' => 'Ijazah SMP wajib diisi',
        //     'ijazah_sma.required' => 'Ijazah SMA wajib diisi',
        // ]);

        $nama = $request->nama;
        $namaDir = str_replace(' ', '_', $nama);
        $baseDir = public_path('img/tendik/' . $namaDir);

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

        $posisi_jabatan = $request->input('posisi_jabatan', 'Default Position');

        $tendik = Tendik::create([
            'nama' => $request->nama,
            'no_nik' => $request->no_nik,
            'no_gtk' => $request->no_gtk,
            'no_nuptk' => $request->no_nuptk,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'status_kepegawaian' => $request->status_kepegawaian,
            'no_rekening' => $request->no_rekening,
            'posisi_jabatan' => $posisi_jabatan,
            'email' => $request->email,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'foto' => $imageNamaFoto,
            'foto_ktp'=> $imageNamaFotoKtp,
            'foto_surat_keterangan_mengajar' => $imageNamaFotoSk
        ]);

        // Menangani upload dan penyimpanan ijazah
        $idTendik = $tendik->id;
        $ijazahData = [];

        if ($request->hasFile('ijazah_smp')) {
            $file = $request->file('ijazah_smp');
            $imageNamaFotoIjazahSmp = $this->fileSetup($file, $nama, 'Foto-Ijazah-SMP-', $namaDir, '/ijazah');
            $ijazahData[] = ['id_guru' => $idTendik, 'jenis_ijazah' => 'SMP', 'nama_file' => $imageNamaFotoIjazahSmp];
        }
        if ($request->hasFile('ijazah_sma')) {
            $file = $request->file('ijazah_sma');
            $imageNamaFotoIjazahSma = $this->fileSetup($file, $nama, 'Foto-Ijazah-SMA-', $namaDir, '/ijazah');
            $ijazahData[] = ['id_guru' => $idTendik, 'jenis_ijazah' => 'SMA', 'nama_file' => $imageNamaFotoIjazahSma];
        }
        if ($request->hasFile('ijazah_s1')) {
            $file = $request->file('ijazah_s1');
            $imageNamaFotoIjazahS1 = $this->fileSetup($file, $nama, 'Foto-Ijazah-S1-', $namaDir, '/ijazah');
            $ijazahData[] = ['id_guru' => $idTendik, 'jenis_ijazah' => 'S1', 'nama_file' => $imageNamaFotoIjazahS1];
        }
        if ($request->hasFile('ijazah_s2')) {
            $file = $request->file('ijazah_s2');
            $imageNamaFotoIjazahS2 = $this->fileSetup($file, $nama, 'Foto-Ijazah-S2-', $namaDir, '/ijazah');
            $ijazahData[] = ['id_guru' => $idTendik, 'jenis_ijazah' => 'S2', 'nama_file' => $imageNamaFotoIjazahS2];
        }
        if ($request->hasFile('ijazah_s3')) {
            $file = $request->file('ijazah_s3');
            $imageNamaFotoIjazahS3 = $this->fileSetup($file, $nama, 'Foto-Ijazah-S3-', $namaDir, '/ijazah');
            $ijazahData[] = ['id_guru' => $idTendik, 'jenis_ijazah' => 'S3', 'nama_file' => $imageNamaFotoIjazahS3];
        }

        // \App\Models\IjazahGuru::insert($ijazahData);

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }
}
