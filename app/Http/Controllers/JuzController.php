<?php

namespace App\Http\Controllers;

//use App\Pencapaian;
use App\Pencapaian;
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
        $juz = Pencapaian::where('tingkatbaca_id','=',2)->sortable('nomor_pencapaian')->paginate(10);
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
            'juz' => ['required', 'integer', 'unique:juz'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('juz.index')->withErrors($validator)->with('error-create', true);
        } else {
            Pencapaian::create($request->all());
            return redirect()->route('juz.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pencapaian  $juz
     * @return \Illuminate\Http\Response
     */
    public function show(Pencapaian $juz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pencapaian  $juz
     * @return \Illuminate\Http\Response
     */
    public function edit(Pencapaian $juz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pencapaian  $juz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pencapaian $juz)
    {
        $validator = validator::make($request->all(), [
            'nomor_pencapaian' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('juz.index')->withErrors($validator)->with(['error-update' => true, 'id' => $juz->id]);
        } else {
            $juz::where('id', $juz->id)
                ->update([
//                    'tingkatbaca_id' => 2,
                    'nomor_pencapaian' => $request->nomor_pencapaian,
                ]);
            return redirect()->route('juz.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pencapaian  $juz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pencapaian $juz)
    {
        Pencapaian::where('id', $juz->id);
        $juz->delete();
        return redirect()->route('juz.index')->with('status', 'Berhasil menghapus data');
    }
}
