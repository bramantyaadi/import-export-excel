<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listdata()
    {
        $siswa = Siswa::all();
        return view('siswa.listdata', ['siswa' => $siswa]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Siswa::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kelas' => $request->kelas,
            'absen' => $request->absen,
        ]);

        $siswa = new Siswa;
        $siswa->nama = $request->get('nama');
        $siswa->alamat = $request->get('alamat');
        $siswa->kelas = $request->get('kelas');
        $siswa->absen = $request->get('absen');
        return 'Siswa berhasil disimpan';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.listdata', ['siswa' => $siswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $siswa = Siswa::find($siswa);

        return view('siswa.edit', ['siswa' => $siswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $siswa = Siswa::find($siswa);
        
        $siswa->nama =$request->nama;
        $siswa->alamat =$request->alamat;
        $siswa->kelas =$request->kelas;
        $siswa->absen =$request->absen;

        $siswa->save();
        return 'Siswa berhasil diubah';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'siswa.xlsx');
    }

    public function import(Request $request) 
    {

        // dd($request->all());
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('Siswa', $namafile);

        Excel::import(new UsersImport, public_path('/Siswa/'.$namafile));
        return redirect('/siswa/create')->with('success', 'All good!');
    }
}
