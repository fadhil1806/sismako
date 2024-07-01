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

    public function fileSetup($file, $nama, $path = '', $prefix) {
        $imageFileName = $prefix . str_replace(' ', '_', $nama) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img/guru' . $path), $imageFileName);
        return $imageFileName;
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
        'foto-ktp.required' => 'Foto KTP wajib diisi',
        'foto_surat_keterangan_mengajar.required' => 'Foto surat keterangan mengajar wajib diisi',
        'ijazah_smp.required' => 'Foto Ijazah Smp wajib diisi',
        'ijazah_sma.required' => 'Foto Ijazah Sma wajib diisi',
    ]);


    mkdir(public_path('img/guru/' . str_replace(' ', '_', $request->nama)));
    
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $imageNamaFoto = $this->fileSetup($file, $request->nama, '/foto', 'Foto-');
    }

    if ($request->hasFile('foto_ktp')) {
        $file = $request->file('foto_ktp');
        $imageNamaFotoKtp = $this->fileSetup($file, $request->nama, '/foto/ktp', 'Foto-KTP-');
    }

    if ($request->hasFile('foto_surat_keterangan_mengajar')) {
        $file = $request->file('foto_surat_keterangan_mengajar');
        $imageNamaFotoSk = $this->fileSetup($file, $request->nama, '/foto/sk', 'Foto-SK-Mengajar-');
    }


        $nama = $request->nama;

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
            'foto_ktp'=>  $imageNamaFotoKtp,
            'foto_surat_keterangan_mengajar' => $imageNamaFotoSk
        ]);

        // Mengambil ID dari guru yang baru disimpan
        $idGuru = $guru->id;
        $pathDirIjazah = public_path('img/guru/foto/ijazah/' . str_replace(' ', '_', $nama));
        $ijazahData = [];

        mkdir($pathDirIjazah, 0777, true);


        if ($request->hasFile('ijazah_smp')) {
            $file = $request->file('ijazah_smp');
            $imageNamaFotoIjazahSmp = $this->fileSetup($file, $nama, '/foto/ijazah/' . str_replace(' ', '_', $nama), 'Foto-Ijazah-SMP-');
            $ijazahData[] = ['id_guru' => $idGuru, 'jenis_ijazah' => 'SMP', 'nama_file' => $imageNamaFotoIjazahSmp];
        }
        if ($request->hasFile('ijazah_sma')) {
            $file = $request->file('ijazah_sma');
            $imageNamaFotoIjazahSma = $this->fileSetup($file, $nama, '/foto/ijazah/' . str_replace(' ', '_', $nama) , 'Foto-Ijazah-SMA-');
            $ijazahData[] = ['id_guru' => $idGuru, 'jenis_ijazah' => 'SMA', 'nama_file' => $imageNamaFotoIjazahSma];
        }
        if ($request->hasFile('ijazah_s1')) {
            $file = $request->file('ijazah_s1');
            $imageNamaFotoIjazahS1 = $this->fileSetup($file, $nama, '/foto/ijazah/' . str_replace(' ', '_', $nama), 'Foto-Ijazah-S1-');
            $ijazahData[] = ['id_guru' => $idGuru, 'jenis_ijazah' => 'S1', 'nama_file' => $imageNamaFotoIjazahS1];
        }
        if ($request->hasFile('ijazah_s2')) {
            $file = $request->file('ijazah_s2');
            $imageNamaFotoIjazahS2 = $this->fileSetup($file, $nama, '/foto/ijazah/' . str_replace(' ', '_', $nama), 'Foto-Ijazah-S2-');
            $ijazahData[] = ['id_guru' => $idGuru, 'jenis_ijazah' => 'S2', 'nama_file' => $imageNamaFotoIjazahS2];
        }
        if ($request->hasFile('ijazah_s3')) {
            $file = $request->file('ijazah_s3');
            $imageNamaFotoIjazahS3 = $this->fileSetup($file, $nama, '/foto/ijazah/' . str_replace(' ', '_', $nama), 'Foto-Ijazah-S3-');
            $ijazahData[] = ['id_guru' => $idGuru, 'jenis_ijazah' => 'S3', 'nama_file' => $imageNamaFotoIjazahS3];
        }

        if(!empty($ijazahData)) {
            IjazahGuru::insert($ijazahData);
        };

        $pathDirSertifikat = public_path('img/guru/foto/sertifikat/' . str_replace(' ', '_', $nama));
        mkdir($pathDirSertifikat, 0777, true);

        $sertifikatData = [];
        if ($request->hasFile('foto_sertifikat')) {
            $files = $request->file('foto_sertifikat');
            foreach ($files as $index => $file) {
                $imageNamaFotoSertifikat = $this->fileSetup($file, $nama . '-' . ($index + 1), '/foto/sertifikat' . str_replace(' ', '_', $nama), 'Foto-Sertifikat-');
                $sertifikatData[] = [
                    'id_guru' => $idGuru,
                    'nama_file' => $imageNamaFotoSertifikat
                ];
            }
        }

        if (!empty($sertifikatData)) {
            SertifikatGuru::insert($sertifikatData);
        }

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil disimpan.');
    }


    public function destroy($id)
    {
        // Menemukan data guru berdasarkan ID
        $guru = Guru::find($id);

        // Pastikan data guru ditemukan
        if (!$guru) {
            return redirect()->route('guru.index')->with('error', 'Data guru tidak ditemukan');
        }

        // Menghapus direktori ijazah dan sertifikat guru
        $nama = $guru->nama;
        $ijazahPath = public_path('/img/guru/foto/ijazah/' . $nama);
        $sertifikatPath = public_path('/img/guru/foto/sertifikat/' . $nama);

        if (File::exists($ijazahPath)) {
            File::deleteDirectory($ijazahPath);
        }

        if (File::exists($sertifikatPath)) {
            File::deleteDirectory($sertifikatPath);
        }

        // Menghapus data guru dari database
        $guru->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus');
    }
}
