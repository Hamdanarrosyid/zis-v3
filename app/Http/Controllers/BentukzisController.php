<?php

namespace App\Http\Controllers;

use App\BentukZis;
use http\Exception;
use Illuminate\Http\Request;

class BentukzisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bentukzis = BentukZis::paginate(5);
        return response()->view('bentukzis.index', compact('bentukzis'));
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
        $this->validate($request,[
            'bentuk'=> ['required','string']
        ]);
        BentukZis::create($request->all());


        return redirect()->route('bentukzis.index')->with('status', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BentukZis  $bentukZis
     * @return \Illuminate\Http\Response
     */
    public function show(BentukZis $bentukZis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BentukZis  $bentukZis
     * @return \Illuminate\Http\Response
     */
    public function edit(BentukZis $bentukZis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BentukZis  $bentukZis
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BentukZis $bentukzis)
    {
        $bentukzis::where('id', $bentukzis->id)
            ->update([
                'bentuk' => $request->bentuk,
            ]);
        return redirect()->route('bentukzis.index',compact('bentukzis'))->with('status', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BentukZis  $bentukZis
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BentukZis $bentukzis)
    {
        try {
            $bentukzis::where('id', $bentukzis->id);
            $bentukzis->delete();
        }
        catch (Exception $exception){

            return redirect()->route('bentukzis.index')->with('error','Tidak dapat menghapus data karena data digunakan pada tabel lain');
        }
        return redirect()->route('bentukzis.index')->with('status', 'Berhasil menghapus data');
    }
}
