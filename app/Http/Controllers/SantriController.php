<?php

namespace App\Http\Controllers;

use App\Iqro;
use App\JenisKelamin;
use App\Juz;
use App\Nilai;
use App\Santri;
use App\Sekolah;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $santri = Santri::paginate(10);

        return response()->view('santri.index', compact('santri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenisKelamin = JenisKelamin::all();
        $sekolah = Sekolah::all();
        $nilai = Nilai::all();

        return response()->view('santri.create', compact('jenisKelamin', 'sekolah', 'nilai'));
    }
    public function pencapaian()
    {
        dd('pp');
        $juz = Juz::all();
        $iqro = Iqro::all();

        return response()->json(compact('juz','iqro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $juz = Juz::all();
        $iqro = Iqro::all();

        return response()->json(compact('juz','iqro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function edit(Santri $santri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Santri $santri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Santri $santri)
    {
        //
    }
}
