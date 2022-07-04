<?php

namespace App\Http\Controllers;

use App\Exports\SiswasExport;
use App\Imports\SiswaImport;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new SiswasExport, 'siswa.xlsx');
    }

    public function import(Request $request)
    {

        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('Siswaaa', $namafile);

        Excel::import(new SiswaImport, public_path('/Siswaaa/' . $namafile));

        return redirect('/siswa')->with('success', 'All good!');
    }

    public function index()
    {
        //
        $siswa = Siswa::all();
        $siswa_chart = Siswa::select('kelas', DB::raw('count(*) as total'))
        ->groupBy('kelas')->get()->toArray();
        return view('siswa.index', ['siswa' => $siswa, 'siswa_chart' => $siswa_chart]);
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
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'koor_long' => $request->koor_long,
            'koor_lat' => $request->koor_lat,
        ]);
        return 'Data siswa berhasil disimpan.';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
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
        //
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
}
