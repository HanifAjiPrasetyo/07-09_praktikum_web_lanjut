<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $mahasiswas = Mahasiswa::all();
        // $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);

        $mahasiswas = Mahasiswa::latest()->paginate(5);

        return view('mahasiswas.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate(['nim' => 'required', 'nama' => 'required', 'kelas' => 'required', 'jurusan' => 'required', 'no_hp' => 'required', 'email' => 'required|email', 'tgl_lahir' => 'required']);

        //fungsi eloquent untuk menambah data
        Mahasiswa::create($request->all());

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.detail', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nim)
    {
        //melakukan validasi data
        $request->validate(['nim' => 'required', 'nama' => 'required', 'kelas' => 'required', 'jurusan' => 'required', 'no_hp' => 'required', 'email' => 'required|email|unique:mahasiswas', 'tgl_lahir' => 'required']);

        //fungsi eloquent untuk mengupdate data inputan kita
        Mahasiswa::find($nim)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }
}
