<?php

namespace App\Http\Controllers;

use App\DasaWisma;
use App\GolonganDarah;
use App\Jamaah;
use App\JenisKelamin;
use App\RT;
use App\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    protected function validation($request)
    {
        $message = [
            'jenis_kelamin_id:The jenis kelamin id field is required.'
        ];
        return validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'jenis_kelamin_id' => ['required', 'string'],
            'tempat_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'dasa_wisma_id' => ['required', 'integer'],
            'rt_id' => ['required', 'integer'],
            'warga_id' => ['required', 'integer'],
            'golongan_darah_id' => ['required', 'integer'],
            'keterangan' => ['required', 'string'],
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator->fails()) {
            return redirect()->route('jamaah.create')->withErrors($validator)->withInput();
        } else {
//            dd($request->request);
            Jamaah::create($request->all());
            return redirect()->route('jamaah.index')->with('status', 'Berhasil menambahkan data');
        }
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
