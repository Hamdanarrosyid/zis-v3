<?php

namespace App\Http\Controllers;

use App\Pencapaian;
use App\Tingkatbaca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PencapaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $tingkatbaca = Tingkatbaca::all();
        $pencapaian = Pencapaian::where('tingkatbaca_id','=',2)->paginate(10);

        return view('tpa.pencapaian.index', compact('pencapaian','tingkatbaca'));
    }

    public function filter(Request $request)
    {
        $tingkatbaca = Tingkatbaca::all();
        $pencapaian = Pencapaian::where('tingkatbaca_id','=',$request->id)->paginate(10);
        return response()->view('tpa.pencapaian.index', compact('pencapaian','tingkatbaca'));
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
            'tingkatbaca_id' => ['required', 'integer'],
            'nomor_pencapaian' => ['required', 'integer', 'unique:pencapaianbaca'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('pencapaian.index')->withErrors($validator)->with('error-create', true);
        } else {
            Pencapaian::create($request->all());
            return redirect()->route('pencapaian.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Pencapaian $pencapaian
     * @return \Illuminate\Http\Response
     */
    public function show(Pencapaian $pencapaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Pencapaian $pencapaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pencapaian $pencapaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Pencapaian $pencapaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pencapaian $pencapaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Pencapaian $pencapaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pencapaian $pencapaian)
    {
        //
    }
}
