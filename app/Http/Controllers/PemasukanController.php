<?php

namespace App\Http\Controllers;

use App\JenisZis;
use App\Pemasukan;
use App\User;
use DB;
use Illuminate\Http\Request;
use PDF;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jeniszis = JenisZis::all();
        $pemasukan = Pemasukan::sortable(['created_at' => 'desc'])->paginate(10);
        $param = [];
        $filter = 0;
        $param[] = null;

        return response()->view('pemasukan.index', ['pemasukan' => $pemasukan, 'jeniszis' => $jeniszis,'param'=>$param,'filter'=>$filter]);
    }

    public function filter(Request $request)
    {
        $this->validate($request,[
           'filter'=>'required|integer'
        ]);
        $jeniszis = JenisZis::all();
        $filter = $request->filter;
        $pemasukan = Pemasukan::sortable(['created_at' => 'desc'])->where('jenis_id', '=', $filter)->paginate(10)->appends('filter',$filter);
        $param = [];
        $param[] = $request->filter;
        return response()->view('pemasukan.index', ['pemasukan' => $pemasukan, 'jeniszis' => $jeniszis,'param'=>$param,'filter'=>$filter]);

    }
    public function pdf(Request $request)
    {
        $filter = $request->filter;

        if ($filter == true){
            $pemasukan = Pemasukan::all()->where('jenis_id','=',$filter);
        }
        else{
            $pemasukan = Pemasukan::all();
        }

        $name = date('Y-m-d');
        $pdf = PDF::loadView('PDF.pemasukan.index',['pemasukan' => $pemasukan]);
        return $pdf->download('Pemasukan'.$name.'.pdf');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        $jeniszis = JenisZis::all();

        //Infaq Ramadhan
        $infaqR = JenisZis::where('jenis', 'LIKE', '%ramadhan%')->get();

        return view('pemasukan.create', ['jeniszis' => $jeniszis, 'users' => $users, 'infaqR' => $infaqR]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis_id' => ['required', 'integer'],
            'tanggal' => ['required', 'date'],
            'nominal' => "required",
            'user_id' => ['required', 'integer'],
            'note' => ['required', 'string', 'max:191']
        ]);
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => ['image']
            ]);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $new_name = time() . '.' . $extension;
            $file->move(public_path('../../public_html/uploads/nota/pemasukan'), $new_name);
        } else {
            $new_name = $request->image;
        }

        Pemasukan::create([
            'jenis_id' => $request->jenis_id,
            'tanggal' => $request->tanggal,
            'nominal' => $request->nominal,
            'note' => $request->note,
            'user_id' => $request->user_id,
            'image' => $new_name
        ]);

        return redirect()->route('pemasukan.index')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Pemasukan $pemasukan
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show(Pemasukan $pemasukan)
    {
        $dwnld = Pemasukan::all()->find($pemasukan->id);
        $path = public_path('../../public_html/uploads/nota/pemasukan/');
        return response()->download($path.$dwnld->image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Pemasukan $pemasukan
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Pemasukan $pemasukan)
    {
        $jenis = JenisZis::all();
        $users = User::all();
        return view('pemasukan.edit', [
            'pemasukan' => $pemasukan,
            'jenis' => $jenis,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Pemasukan $pemasukan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pemasukan $pemasukan)
    {
        $this->validate($request, [
            'jenis_id' => ['required', 'integer'],
            'tanggal' => ['required', 'date'],
            'nominal' => "required",
            'user_id' => ['required', 'integer'],
            'note' => ['required', 'string', 'max:191']
        ]);
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => ['image']
            ]);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $new_name = time(). '.' . $extension;
            $file->move(public_path('../../public_html/uploads/nota/pemasukan'), $new_name);
        } else {
            $new_name = $pemasukan->image;
        }
        Pemasukan::where('id', $pemasukan->id)
            ->Update([
                'jenis_id' => $request->jenis_id,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'note' => $request->note,
                'user_id' => $request->user_id,
                'image' => $new_name
            ]);
        return redirect()->route('pemasukan.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Pemasukan $pemasukan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pemasukan $pemasukan)
    {
        Pemasukan::destroy($pemasukan->id);
        return redirect()->route('pemasukan.index')->with('status', 'Data berhasil dihapus');
    }
}
