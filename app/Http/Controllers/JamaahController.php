<?php

namespace App\Http\Controllers;

use App\DasaWisma;
use App\GolonganDarah;
use App\Jamaah;
use App\JenisKelamin;
use App\RT;
use App\Warga;
use Illuminate\Http\Request;

class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jamaah = Jamaah::paginate(10);

        return response()->view('data_jamaah.jamaah.index', compact('jamaah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenisKelamin = JenisKelamin::all();
        $golonganDarah = GolonganDarah::all();
        $warga = Warga::all();
        $dasaWisma = DasaWisma::all();
        $rt = RT::all();

        return response()->view('data_jamaah.jamaah.create', compact('jenisKelamin','golonganDarah','warga','dasaWisma','rt'));
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
     * @param  \App\Jamaah  $jamaah
     * @return \Illuminate\Http\Response
     */
    public function show(Jamaah $jamaah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jamaah  $jamaah
     * @return \Illuminate\Http\Response
     */
    public function edit(Jamaah $jamaah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jamaah  $jamaah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jamaah $jamaah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jamaah  $jamaah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jamaah $jamaah)
    {
        //
    }
}
