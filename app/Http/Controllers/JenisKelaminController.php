<?php

namespace App\Http\Controllers;

use App\JenisKelamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisKelaminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisKelamin = JenisKelamin::paginate(10);
        return response()->view('data_jamaah.jenis_kelamin.index', ['jenisKelamin' => $jenisKelamin]);
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
            'jenis_kelamin' => ['required', 'string','unique:jenis_kelamin'],
        ]);
        if ($validator->fails()) {
            $this->validationFail = true;
            return redirect()->route('jenis_kelamin.index')->withErrors($validator)->with('error-create', true);
        } else {
            JenisKelamin::create($request->all());
            return redirect()->route('jenis_kelamin.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JenisKelamin  $jenisKelamin
     * @return \Illuminate\Http\Response
     */
    public function show(JenisKelamin $jenisKelamin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisKelamin  $jenisKelamin
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisKelamin $jenisKelamin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisKelamin  $jenisKelamin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, JenisKelamin $jenisKelamin)
    {
        $validator = validator::make($request->all(), [
            'jenis_kelamin' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('jenis_kelamin.index')->withErrors($validator)->with(['error-update'=>true,'id'=>$jenisKelamin->id]);
        } else {
            $jenisKelamin::where('id', $jenisKelamin->id)
                ->update([
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            return redirect()->route('jenis_kelamin.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisKelamin  $jenisKelamin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(JenisKelamin $jenisKelamin)
    {
        $jenisKelamin::where('id', $jenisKelamin->id);
        $jenisKelamin->delete();return redirect()->route('jenis_kelamin.index')->with('status', 'Berhasil menghapus data');
    }
}
