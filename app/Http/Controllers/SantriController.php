<?php

namespace App\Http\Controllers;

use App\Iqro;
use App\JenisKelamin;
use App\Juz;
use App\Nilai;
use App\Pencapaian;
use App\Santri;
use App\Sekolah;
use App\Tingkatbaca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        return response()->view('tpa.santri.index', compact('santri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenisKelamin = JenisKelamin::all();
        $tingkatbaca = Tingkatbaca::all();
        $sekolah = Sekolah::all();
        $nilai = Nilai::all()->sortBy('nilai');

        return response()->view('tpa.santri.create', compact('jenisKelamin', 'tingkatbaca', 'sekolah', 'nilai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'nama_santri' => ['required', 'string', 'unique:santri'],
            'jenis_kelamin_id' => ['required', 'integer'],
            'tempat_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'sekolah_id' => ['required', 'integer'],
            'tingkat_baca_id' => ['required', 'integer'],
            'juz_id' => ['integer'],
            'iqro_id' => ['integer'],
            'nilai_id' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('santri.create')->withErrors($validator)->withInput();
        } else {
            Santri::create($request->all());
            return redirect()->route('santri.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Santri $santri
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {

//        $pencapaian = Pencapaian::all()->mapToGroups(function ($data){
//            $id = $data->id;
//            $tingkatbaca_id = $data->tingkatbaca_id;
//            $nomor_pencapaian = $data->nomor_pencapaian;
////            $p = Tingkatbaca::where('id','=',$data->tingkatbaca_id)->get();
////            dd($p->nama_tingkatan);
//            return ['pencapaian'=>compact('id','tingkatbaca_id','nomor_pencapaian')];
//        })->toArray();
        $pencapaian = Pencapaian::all();

        return response()->json(compact('pencapaian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Santri $santri
     * @return \Illuminate\Http\Response
     */
    public function edit(Santri $santri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Santri $santri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Santri $santri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Santri $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Santri $santri)
    {
        //
    }
}
