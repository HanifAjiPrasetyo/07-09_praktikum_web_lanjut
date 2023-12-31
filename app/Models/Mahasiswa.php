<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = "mahasiswas"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    // public $timestamps = false;
    protected $primaryKey = 'nim'; // Memanggil isi DB Dengan primarykey

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['nim', 'nama', 'kelas_id', 'jurusan', 'no_hp', 'email', 'tgl_lahir'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mahasiswa_matkul()
    {
        return $this->hasMany(Mahasiswa_MataKuliah::class);
    }
}
