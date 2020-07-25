<?php

namespace App\Http\Controllers;

use App\JenisZis;
use App\Laporan;
use Exception;
use Illuminate\Http\Request;

class JenisZisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jeniszis = JenisZis::paginate(10);
        return response()->view('jeniszis.index', ['jeniszis' => $jeniszis]);
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'jenis'=> ['required','string']
        ]);
       JenisZis::create($request->all());


        return redirect()->route('jeniszis.index')->with('status', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\JenisZis $jenisZis
     * @return \Illuminate\Http\Response
     */
    public function show(JenisZis $jenisZis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\JenisZis $jenisZis
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisZis $jenisZis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\JenisZis $jeniszis
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, JenisZis $jeniszis)
    {
        $jeniszis::where('id', $jeniszis->id)
            ->update([
                'jenis' => $request->jenis,
            ]);
        return redirect()->route('jeniszis.index', ['jeniszis' => $jeniszis])->with('status', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\JenisZis $jeniszis
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(JenisZis $jeniszis)
    {
        try {
            $jeniszis::where('id', $jeniszis->id);
            $jeniszis->delete();
        }
        catch (Exception $exception){

            return redirect()->route('jeniszis.index')->with('error','Tidak dapat menghapus data karena data digunakan pada tabel lain');
        }
        return redirect()->route('jeniszis.index')->with('status', 'Berhasil menghapus data');
    }
}
