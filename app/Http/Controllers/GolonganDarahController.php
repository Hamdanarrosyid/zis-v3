<?php

namespace App\Http\Controllers;

use App\GolonganDarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GolonganDarahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $golonganDarah = GolonganDarah::paginate(10);
        return response()->view('data_jamaah.golongan_darah.index', ['golonganDarah' => $golonganDarah]);
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
            'golongan_darah' => ['required', 'string','unique:golongan_darah'],
        ]);
        if ($validator->fails()) {
            $this->validationFail = true;
            return redirect()->route('golongan_darah.index')->withErrors($validator)->with('error-create', true);
        } else {
            GolonganDarah::create($request->all());
            return redirect()->route('golongan_darah.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GolonganDarah  $golonganDarah
     * @return \Illuminate\Http\Response
     */
    public function show(GolonganDarah $golonganDarah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GolonganDarah  $golonganDarah
     * @return \Illuminate\Http\Response
     */
    public function edit(GolonganDarah $golonganDarah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GolonganDarah  $golonganDarah
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, GolonganDarah $golonganDarah)
    {
        $validator = validator::make($request->all(), [
            'golongan_darah' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('golongan_darah.index')->withErrors($validator)->with(['error-update'=>true,'id'=>$golonganDarah->id]);
        } else {
            $golonganDarah::where('id', $golonganDarah->id)
                ->update([
                    'golongan_darah' => $request->golongan_darah,
                ]);
            return redirect()->route('golongan_darah.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GolonganDarah  $golonganDarah
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(GolonganDarah $golonganDarah)
    {
        GolonganDarah::where('id', $golonganDarah->id);
        $golonganDarah->delete();return redirect()->route('golongan_darah.index')->with('status', 'Berhasil menghapus data');
    }
}
