<?php

namespace App\Http\Controllers;

use App\Iqro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IqroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $iqro = Iqro::sortable(['jilid'=>'asc'])->paginate(10);
        return view('tpa.iqro.index',compact('iqro'));
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
            'jilid' => ['required', 'string', 'unique:iqro'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('iqro.index')->withErrors($validator)->with('error-create', true);
        } else {
            Iqro::create($request->all());
            return redirect()->route('iqro.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Iqro  $iqro
     * @return \Illuminate\Http\Response
     */
    public function show(Iqro $iqro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Iqro  $iqro
     * @return \Illuminate\Http\Response
     */
    public function edit(Iqro $iqro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Iqro  $iqro
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Iqro $iqro)
    {
        $validator = validator::make($request->all(), [
            'jilid' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('iqro.index')->withErrors($validator)->with(['error-update' => true, 'id' => $iqro->id]);
        } else {
            $iqro::where('id', $iqro->id)
                ->update([
                    'jilid' => $request->jilid,
                ]);
            return redirect()->route('iqro.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Iqro  $iqro
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Iqro $iqro)
    {
        Iqro::where('id', $iqro->id);
        $iqro->delete();
        return redirect()->route('iqro.index')->with('status', 'Berhasil menghapus data');
    }
}
