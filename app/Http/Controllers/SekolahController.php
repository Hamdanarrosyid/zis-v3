<?php

namespace App\Http\Controllers;

use App\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $sekolah = Sekolah::paginate(10);
        return view('tpa.sekolah.index', compact('sekolah'));
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
            'jenjang_sekolah' => ['required', 'string', 'unique:sekolah'],
            'nama_sekolah' => ['required', 'string', 'unique:sekolah'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('sekolah.index')->withErrors($validator)->with('error-create', true);
        } else {
            Sekolah::create($request->all());
            return redirect()->route('sekolah.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Sekolah $sekolah
     * @return \Illuminate\Http\Response
     */
    public function show(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sekolah $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sekolah $sekolah
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        $validator = validator::make($request->all(), [
            'jenjang_sekolah' => ['required', 'string'],
            'nama_sekolah' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('sekolah.index')->withErrors($validator)->with(['error-update' => true, 'id' => $sekolah->id]);
        } else {
            $sekolah::where('id', $sekolah->id)
                ->update([
                    'jenjang_sekolah' => $request->jenjang_sekolah,
                    'nama_sekolah' => $request->nama_sekolah,
                ]);
            return redirect()->route('sekolah.index')->with('status', 'Berhasil mengubah data');
        }
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Sekolah $sekolah
         * @return \Illuminate\Http\RedirectResponse
         */
        public
        function destroy(Sekolah $sekolah)
        {
            Sekolah::where('id', $sekolah->id);
            $sekolah->delete();
            return redirect()->route('sekolah.index')->with('status', 'Berhasil menghapus data');
        }
    }
