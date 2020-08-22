<?php

namespace App\Http\Controllers;

use App\RT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $RT = RT::paginate(10);
        return response()->view('data_jamaah.rt.index', ['RT' => $RT]);
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
            'nomor_rt' => ['required', 'string','unique:rt'],
        ]);
        if ($validator->fails()) {
            $this->validationFail = true;
            return redirect()->route('RT.index')->withErrors($validator)->with('error-create', true);
        } else {
            RT::create($request->all());
            return redirect()->route('RT.index')->with('status', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RT  $RT
     * @return \Illuminate\Http\Response
     */
    public function show(RT $RT)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RT  $RT
     * @return \Illuminate\Http\Response
     */
    public function edit(RT $RT)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RT  $RT
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RT $RT)
    {
        $validator = validator::make($request->all(), [
            'nomor_rt' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('RT.index')->withErrors($validator)->with(['error-update'=>true,'id'=>$RT->id]);
        } else {
            $RT::where('id', $RT->id)
                ->update([
                    'nomor_rt' => $request->nomor_rt,
                ]);
            return redirect()->route('RT.index')->with('status', 'Berhasil mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RT  $RT
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RT $RT)
    {
        $RT::where('id', $RT->id);
        $RT->delete();return redirect()->route('RT.index')->with('status', 'Berhasil menghapus data');
    }
}
