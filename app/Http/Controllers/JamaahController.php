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

        return response()->view('data_jamaah.jamaah.create', compact('jenisKelamin', 'golonganDarah', 'warga', 'dasaWisma', 'rt'));
    }

    protected function validation($request)
    {
        $message = [
            'jenis_kelamin_id.required' => 'The jenis kelamin field is required.',
            'jenis_kelamin_id.integer' => 'The jenis kelamin must be an integer.',
            'dasa_wisma_id.required' => 'The dasa wisma field is required.',
            'dasa_wisma_id.integer' => 'The dasa wisma must be an integer.',
            'rt_id.required' => 'The RT field is required.',
            'rt_id.integer' => 'The RT must be an integer.',
            'golongan_darah.required' => 'The golongan darah field is required.',
            'golongan_darah.integer' => 'The golongan darah must be an integer.',
        ];
        return validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'jenis_kelamin_id' => ['required', 'integer'],
            'tempat_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'dasa_wisma_id' => ['required', 'integer'],
            'rt_id' => ['required', 'integer'],
            'warga_id' => ['required', 'integer'],
            'golongan_darah_id' => ['required', 'integer'],
            'keterangan' => ['required', 'string'],
        ], $message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator->fails()) {
            return redirect()->route('jamaah.create')->withErrors($validator)->withInput();
        } else {
            Jamaah::create($request->all());
            return redirect()->route('jamaah.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Jamaah $jamaah
     * @return \Illuminate\Http\Response
     */
    public function show(Jamaah $jamaah)
    {
        $jenisKelamin = JenisKelamin::all();
        $golonganDarah = GolonganDarah::all();
        $warga = Warga::all();
        $dasaWisma = DasaWisma::all();
        $rt = RT::all();

        return response()->view('data_jamaah.jamaah.show', compact('jamaah', 'jenisKelamin', 'golonganDarah', 'warga', 'dasaWisma', 'rt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Jamaah $jamaah
     * @return \Illuminate\Http\Response
     */
    public function edit(Jamaah $jamaah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Jamaah $jamaah
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Jamaah $jamaah)
    {
        $validator = $this->validation($request);
        if ($validator->fails()) {
            return redirect()->route('jamaah.show',['jamaah'=>$jamaah->id])->withErrors($validator);
        } else {
            Jamaah::where('id', $jamaah->id)->update([
                'nama' => $request->nama,
                'jenis_kelamin_id' => $request->jenis_kelamin_id,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'dasa_wisma_id' => $request->dasa_wisma_id,
                'rt_id' => $request->rt_id,
                'warga_id' => $request->warga_id,
                'golongan_darah_id' => $request->golongan_darah_id,
                'keterangan' => $request->keterangan,
            ]);
            return redirect()->route('jamaah.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Jamaah $jamaah
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Jamaah $jamaah)
    {
        DasaWisma::where('id', $jamaah->id);
        $jamaah->delete();
        return redirect()->route('jamaah.index')->with('status', 'Berhasil menghapus data');
    }
}
