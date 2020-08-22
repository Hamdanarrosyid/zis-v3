<?php

namespace App\Http\Controllers;

use App\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warga = Warga::paginate(10);
        return response()->view('data_jamaah.warga.index', ['warga' => $warga]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'status_warga' => ['required', 'string','unique:warga'],
        ]);
        if ($validator->fails()) {
            $this->validationFail = true;
            return redirect()->route('warga.index')->withErrors($validator)->with('error-create', true);
        } else {
            Warga::create($request->all());
            return redirect()->route('warga.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warga  $warga
     * @return \Illuminate\Http\Response
     */
    public function show(Warga $warga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warga  $warga
     * @return \Illuminate\Http\Response
     */
    public function edit(Warga $warga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warga  $warga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Warga $warga)
    {
        $validator = validator::make($request->all(), [
            'status_warga' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('RT.index')->withErrors($validator)->with(['error-update'=>true,'id'=>$warga->id]);
        } else {
            $warga::where('id', $warga->id)
                ->update([
                    'status_warga' => $request->status_warga,
                ]);
            return redirect()->route('warga.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warga  $warga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Warga $warga)
    {
        Warga::where('id', $warga->id);
        $warga->delete();return redirect()->route('warga.index')->with('status', 'Berhasil menghapus data');
    }
}
