<?php

namespace App\Http\Controllers;

use App\BentukZis;
use App\PengeluaranBentuk;
use App\User;
use Illuminate\Http\Request;
use PDF;

class PengeluaranBentukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bentukzis = BentukZis::all();
        $pengeluaran = PengeluaranBentuk::sortable(['created_at' => 'desc'])->paginate(10);
        $param = [];
        $filter = 0;
        $param[] = null;

        return response()->view('pengeluaran_bentuk.index', ['pengeluaran' => $pengeluaran, 'bentukzis' => $bentukzis,'param'=>$param,'filter'=>$filter]);
    }
    public function filter(Request $request)
    {
        $this->validate($request,[
            'filter'=>'required|integer'
        ]);
        $bentukzis = BentukZis::all();
        $filter = $request->filter;
        $pengeluaran = PengeluaranBentuk::sortable(['created_at' => 'desc'])->where('bentuk_id', '=', $filter)->paginate(10)->appends('filter',$filter);
        $param = [];
        $param[] = $request->filter;

        return response()->view('pengeluaran_bentuk.index', ['pengeluaran' => $pengeluaran, 'bentukzis' => $bentukzis,'param'=>$param,'filter'=>$filter]);

    }
    public function pdf(Request $request)
    {
        $filter = $request->filter;

        if ($filter == true){
            $pengeluaran = PengeluaranBentuk::all()->where('bentuk_id','=',$filter);
        }
        else{
            $pengeluaran = PengeluaranBentuk::all();
        }

        $name = date('Y-m-d');
        $pdf = PDF::loadView('PDF.pengeluaran_bentuk.index',['pengeluaran' => $pengeluaran]);
        return $pdf->download('PengeluaranBentuk'.$name.'.pdf');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        $bentukzis = BentukZis::all();

        //Infaq Ramadhan
        $infaqR = BentukZis::where('bentuk', 'LIKE', '%ramadhan%')->get();

        return view('pengeluaran_bentuk.create',['users'=>$users,'bentukzis'=>$bentukzis,'infaqR'=>$infaqR]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        dd($request);
        $this->validate($request, [
            'keperluan' => ['required', 'string', 'max:191'],
            'bentuk_id' => ['required', 'integer'],
            'tanggal' => ['required', 'date'],
            'user_id' => ['required', 'integer'],
            'note' => ['required', 'string', 'max:191'],
        ]);
        PengeluaranBentuk::create($request->all());

        return redirect()->route('pengeluaran-bentuk.index')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PengeluaranBentuk  $pengeluaranBentuk
     * @return \Illuminate\Http\Response
     */
    public function show(PengeluaranBentuk $pengeluaranBentuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PengeluaranBentuk  $pengeluaranBentuk
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(PengeluaranBentuk $pengeluaran_bentuk)
    {
        $bentukzis = BentukZis::all();
        $users = User::all();
        return view('pengeluaran_bentuk.edit', [
            'pengeluaran' => $pengeluaran_bentuk,
            'bentukzis' => $bentukzis,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PengeluaranBentuk  $pengeluaranBentuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PengeluaranBentuk $pengeluaran_bentuk)
    {
        $this->validate($request, [
            'bentuk_id' => ['required', 'integer'],
            'tanggal' => ['required', 'date'],
            'user_id' => ['required', 'integer'],
            'note' => ['required', 'string', 'max:191'],
            'keperluan' => ['required', 'string', 'max:191'],
        ]);
        PengeluaranBentuk::where('id', $pengeluaran_bentuk->id)
            ->Update([
                'keperluan' => $request->keperluan,
                'bentuk_id' => $request->bentuk_id,
                'tanggal' => $request->tanggal,
                'note' => $request->note,
                'user_id' => $request->user_id,
            ]);
        return redirect()->route('pengeluaran-bentuk.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PengeluaranBentuk  $pengeluaranBentuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PengeluaranBentuk $pengeluaran_bentuk)
    {
        PengeluaranBentuk::destroy($pengeluaran_bentuk->id);
        return redirect()->route('pengeluaran-bentuk.index')->with('status', 'Data berhasil dihapus');
    }
}
