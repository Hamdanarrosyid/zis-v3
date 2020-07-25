<?php

namespace App\Http\Controllers;

use App\JenisZis;
use App\Pengeluaran;
use App\User;
use Illuminate\Http\Request;
use PDF;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jeniszis = JenisZis::all();
        $pengeluaran = Pengeluaran::sortable(['created_at'=>'desc'])->paginate(10);
        $filter = 0;
        $param = [];
        $param[] = null;

        return response()->view('pengeluaran.index',compact('jeniszis','pengeluaran','param','filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $this->validate($request,[
            'filter'=>'required|integer'
        ]);
        $jeniszis = JenisZis::all();
        $filter = $request->filter;
        $pengeluaran = Pengeluaran::sortable(['created_at' => 'desc'])->where('jenis_id','=',$filter)->paginate(10)->appends('filter',$filter);

        $param = [];
        $param[] = $request->filter;

//        dd($coba);

         return response()->view('pengeluaran.index',compact('jeniszis','pengeluaran','param','filter'));

    }

    public function pdf(Request $request)
    {
        $filter = $request->filter;

        if ($filter == true){
            $pengeluaran = Pengeluaran::all()->where('jenis_id','=',$filter);
        }
        else{
            $pengeluaran = Pengeluaran::all();
        }

        $name = date('Y-m-d');
        $pdf = PDF::loadView('PDF.pengeluaran.index',['pengeluaran' => $pengeluaran]);
        return $pdf->download('Pengeluaran'.$name.'.pdf');

    }

    public function create()
    {
        $users = User::all();
        $jenis = JenisZis::all();
        $pengeluaran = Pengeluaran::all();
        return view('pengeluaran.create', ['users' => $users, 'jenis' => $jenis, 'pengeluaran' => $pengeluaran]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'keperluan' => ['required', 'string'],
            'jenis_id' => ['required', 'integer'],
            'tanggal' => ['required', 'date'],
            'nominal' => "required",
            'note' => ['required','string','max:191'],
            'user_id' => ['required', 'integer']
        ]);
        if ($request->hasFile('image')){
            $this->validate($request,[
                'image'=>['image']
            ]);
           $file = $request->file('image');
           $extension = $file->getClientOriginalExtension();
           $new_name = time().'.'.$extension;
           $file->move(public_path('../../public_html/uploads/nota/pengeluaran'),$new_name);
        }
        else{
            $new_name = $request->image;
    }

       Pengeluaran::create([
           'keperluan'=>$request->keperluan,
           'jenis_id'=>$request->jenis_id,
           'tanggal'=>$request->tanggal,
           'nominal'=>$request->nominal,
           'note'=>$request->note,
           'user_id'=>$request->user_id,
           'image'=>$new_name
       ]);


        return redirect()->route('pengeluaran.index')->with('status', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Pengeluaran $pengeluaran
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show(Pengeluaran $pengeluaran)
    {
//        dd($pengeluaran);
        $dwnld = Pengeluaran::all()->find($pengeluaran->id);
        $path = public_path('../../public_html/uploads/nota/pengeluaran/');
        return response()->download($path.$dwnld->image);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Pengeluaran $pengeluaran
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        $jenis = JenisZis::all();
        $users = User::all();
        return view('pengeluaran.edit', [
            'pengeluaran'=> $pengeluaran,
            'users' => $users,
            'jenis'=>$jenis
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Pengeluaran $pengeluaran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $this->validate($request, [
            'keperluan' => ['required', 'string'],
            'jenis_id' => ['required', 'integer'],
            'tanggal' => ['required', 'date'],
            'nominal' => "required",
            'note' => ['required', 'string','max:191'],
            'user_id' => ['required', 'integer']
        ]);
        if ($request->hasFile('image')){
            $this->validate($request,[
                'image'=>['image']
            ]);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $new_name = time().'.'.$extension;
            $file->move(public_path('../../public_html/uploads/nota/pengeluaran'),$new_name);
        }
        else{
            $new_name = $pengeluaran->image;
        }
        Pengeluaran::where('id', $pengeluaran->id)
            ->Update([
                'keperluan' => $request->keperluan,
                'jenis_id'  => $request->jenis_id,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'note' => $request->note,
                'user_id' => $request->user_id,
                'image'=>$new_name
            ]);
        return redirect()->route('pengeluaran.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Pengeluaran $pengeluaran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $dd = $pengeluaran->id;
        Pengeluaran::destroy($dd);

        return redirect()->route('pengeluaran.index')->with('status', 'Data berhasil dihapus');
    }
}
