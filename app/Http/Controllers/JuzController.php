<?php

namespace App\Http\Controllers;

use App\Juz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JuzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $juz = Juz::sortable('juz')->paginate(10);
        return view('tpa.juz.index',compact('juz'));
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
            'juz' => ['required', 'string', 'unique:juz'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('juz.index')->withErrors($validator)->with('error-create', true);
        } else {
            Juz::create($request->all());
            return redirect()->route('juz.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Juz  $juz
     * @return \Illuminate\Http\Response
     */
    public function show(Juz $juz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Juz  $juz
     * @return \Illuminate\Http\Response
     */
    public function edit(Juz $juz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Juz  $juz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Juz $juz)
    {
        $validator = validator::make($request->all(), [
            'juz' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('juz.index')->withErrors($validator)->with(['error-update' => true, 'id' => $juz->id]);
        } else {
            $juz::where('id', $juz->id)
                ->update([
                    'juz' => $request->juz,
                ]);
            return redirect()->route('juz.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Juz  $juz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Juz $juz)
    {
        Juz::where('id', $juz->id);
        $juz->delete();
        return redirect()->route('juz.index')->with('status', 'Berhasil menghapus data');
    }
}
