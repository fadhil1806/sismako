<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tendik extends Model
{
    use HasFactory;

    protected $table = 'tendik';
    protected $primaryKey = 'id'; // Sesuaikan dengan nama kunci utama pada tabel 'guru'

    protected $fillable = [
        'nama',
        'no_nik',
        'no_gtk',
        'no_nuptk',
        'tempat_tanggal_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'status_kepegawaian',
        'no_rekening',
        'posisi',
        'email',
        'pendidikan_terakhir',
        'tanggal_masuk',
        'tanggal_keluar',
        'foto',
        'foto_ktp',
        'foto_surat_keterangan_mengajar',
    ];

    protected $dates = [
        'tanggal_lahir',
        'tanggal_masuk',
        'tanggal_keluar',
    ];
}
