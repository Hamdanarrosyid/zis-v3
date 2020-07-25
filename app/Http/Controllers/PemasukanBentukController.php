<?php

namespace App\Http\Controllers;

use App\BentukZis;
use App\PemasukanBentuk;
use App\User;
use Illuminate\Http\Request;
use PDF;

class PemasukanBentukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bentukzis = BentukZis::all();
        $pemasukan = PemasukanBentuk::sortable(['created_at' => 'desc'])->paginate(10);
        $param = [];
        $filter = 0;
        $param[] = null;

        return response()->view('pemasukan_bentuk.index', ['pemasukan' => $pemasukan, 'bentukzis' => $bentukzis,'param'=>$param,'filter'=>$filter]);
    }
    public function filter(Request $request)
    {
        $this->validate($request,[
            'filter'=>'required|integer'
        ]);
        $bentukzis = BentukZis::all();
        $filter = $request->filter;
        $pemasukan = PemasukanBentuk::sortable(['created_at' => 'desc'])->where('bentuk_id', '=', $filter)->paginate(10)->appends('filter',$filter);
        $param = [];
        $param[] = $request->filter;

        return response()->view('pemasukan_bentuk.index', ['pemasukan' => $pemasukan, 'bentukzis' => $bentukzis,'param'=>$param,'filter'=>$filter]);

    }
    public function pdf(Request $request)
    {
        $filter = $request->filter;

        if ($filter == true){
            $pemasukan = PemasukanBentuk::all()->where('bentuk_id','=',$filter);
        }
        else{
            $pemasukan = PemasukanBentuk::all();
        }

        $name = date('Y-m-d');
        $pdf = PDF::loadView('PDF.pemasukan_bentuk.index',['pemasukan' => $pemasukan]);
        return $pdf->download('PemasukanBentuk'.$name.'.pdf');

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

        return view('pemasukan_bentuk.create',['users'=>$users,'bentukzis'=>$bentukzis,'infaqR'=>$infaqR]);
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
            'bentuk_id' => ['required', 'integer'],
            'tanggal' => ['required', 'date'],
            'user_id' => ['required', 'integer'],
            'note' => ['required', 'string', 'max:191']
        ]);
        PemasukanBentuk::create($request->all());

        return redirect()->route('pemasukan-bentuk.index')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PemasukanBentuk  $pemasukanBentuk
     * @return \Illuminate\Http\Response
     */
    public function show(PemasukanBentuk $pemasukan_bentuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PemasukanBentuk  $pemasukanBentuk
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(PemasukanBentuk $pemasukan_bentuk)
    {
        $bentukzis = BentukZis::all();
        $users = User::all();
        return view('pemasukan_bentuk.edit', [
            'pemasukan' => $pemasukan_bentuk,
            'bentukzis' => $bentukzis,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PemasukanBentuk  $pemasukanBentuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PemasukanBentuk $pemasukan_bentuk)
    {
        // dd($request);
        $this->validate($request, [
            'bentuk_id' => ['required', 'integer'],
            'tanggal' => ['required', 'date'],
            'user_id' => ['required', 'integer'],
            'note' => ['required', 'string', 'max:191']
        ]);
        PemasukanBentuk::where('id', $pemasukan_bentuk->id)
            ->Update([
                'bentuk_id' => $request->bentuk_id,
                'tanggal' => $request->tanggal,
                'note' => $request->note,
                'user_id' => $request->user_id,
            ]);
        return redirect()->route('pemasukan-bentuk.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PemasukanBentuk  $pemasukanBentuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PemasukanBentuk $pemasukan_bentuk)
    {
        PemasukanBentuk::destroy($pemasukan_bentuk->id);
        return redirect()->route('pemasukan-bentuk.index')->with('status', 'Data berhasil dihapus');
    }
}
