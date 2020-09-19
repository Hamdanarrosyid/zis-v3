<?php

namespace App\Http\Controllers;

use App\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $nilai = Nilai::sortable(['nilai'=>'asc'])->paginate(10);
        return view('tpa.nilai.index',compact('nilai'));
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
            'nilai' => ['required', 'string', 'unique:nilai'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('nilai.index')->withErrors($validator)->with('error-create', true);
        } else {
            Nilai::create($request->all());
            return redirect()->route('nilai.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Nilai $nilai)
    {
        $validator = validator::make($request->all(), [
            'nilai' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('nilai.index')->withErrors($validator)->with(['error-update' => true, 'id' => $nilai->id]);
        } else {
            $nilai::where('id', $nilai->id)
                ->update([
                    'nilai' => $request->nilai,
                ]);
            return redirect()->route('nilai.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Nilai $nilai)
    {
        Nilai::where('id', $nilai->id);
        $nilai->delete();
        return redirect()->route('nilai.index')->with('status', 'Berhasil menghapus data');
    }
}
