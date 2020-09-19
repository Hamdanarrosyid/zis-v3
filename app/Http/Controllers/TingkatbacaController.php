<?php

namespace App\Http\Controllers;

use App\Tingkatbaca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TingkatbacaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $tingkatbaca = Tingkatbaca::paginate(10);
        return view('tpa.tingkatbaca.index',compact('tingkatbaca'));
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
            'tingkat_baca' => ['required', 'string', 'unique:tingkatbaca'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('tingkatbaca.index')->withErrors($validator)->with('error-create', true);
        } else {
            Tingkatbaca::create($request->all());
            return redirect()->route('tingkatbaca.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tingkatbaca  $tingkatbaca
     * @return \Illuminate\Http\Response
     */
    public function show(Tingkatbaca $tingkatbaca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tingkatbaca  $tingkatbaca
     * @return \Illuminate\Http\Response
     */
    public function edit(Tingkatbaca $tingkatbaca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tingkatbaca  $tingkatbaca
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Tingkatbaca $tingkatbaca)
    {
        $validator = validator::make($request->all(), [
            'tingkat_baca' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('tingkatbaca.index')->withErrors($validator)->with(['error-update' => true, 'id' => $tingkatbaca->id]);
        } else {
            $tingkatbaca::where('id', $tingkatbaca->id)
                ->update([
                    'tingkat_baca' => $request->tingkat_baca,
                ]);
            return redirect()->route('tingkatbaca.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tingkatbaca  $tingkatbaca
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tingkatbaca $tingkatbaca)
    {
        Tingkatbaca::where('id', $tingkatbaca->id);
        $tingkatbaca->delete();
        return redirect()->route('tingkatbaca.index')->with('status', 'Berhasil menghapus data');
    }
}
