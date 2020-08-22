<?php

namespace App\Http\Controllers;

use App\DasaWisma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DasaWismaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dasaWisma = DasaWisma::paginate(10);
        return response()->view('data_jamaah.dasa_wisma.index', ['dasaWisma' => $dasaWisma]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama_dasa_wisma' => ['required', 'string','unique:dasa_wisma'],
            'jumlah_krt' => ['required', 'min:0', 'numeric'],
            'jumlah_kk' => ['required', 'min:0', 'numeric']
        ]);
        if ($validator->fails()) {
            return redirect()->route('dasa_wisma.index')->withErrors($validator)->with('error-create', true);
        } else {
            DasaWisma::create($request->all());
            return redirect()->route('dasa_wisma.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\DasaWisma $dasaWisma
     * @return \Illuminate\Http\Response
     */
    public function show(DasaWisma $dasaWisma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\DasaWisma $dasaWisma
     * @return \Illuminate\Http\Response
     */
    public function edit(DasaWisma $dasaWisma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\DasaWisma $dasaWisma
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, DasaWisma $dasaWisma)
    {
        $validator = validator::make($request->all(), [
            'nama_dasa_wisma' => ['required', 'string'],
            'jumlah_krt' => ['required', 'min:0', 'numeric'],
            'jumlah_kk' => ['required', 'min:0', 'numeric']
        ]);
        if ($validator->fails()) {
            return redirect()->route('dasa_wisma.index')->withErrors($validator)->with(['error-update'=>true,'id'=>$dasaWisma->id]);
        } else {
            $dasaWisma::where('id', $dasaWisma->id)
                ->update([
                    'nama_dasa_wisma' => $request->nama_dasa_wisma,
                    'jumlah_krt' => $request->jumlah_krt,
                    'jumlah_kk' => $request->jumlah_kk,
                ]);
            return redirect()->route('dasa_wisma.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\DasaWisma $dasaWisma
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DasaWisma $dasaWisma)
    {
        DasaWisma::where('id', $dasaWisma->id);
        $dasaWisma->delete();
        return redirect()->route('dasa_wisma.index')->with('status', 'Berhasil menghapus data');
    }
}
