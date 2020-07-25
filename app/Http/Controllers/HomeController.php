<?php

namespace App\Http\Controllers;

use App\JenisZis;
use App\Pemasukan;
use App\Pengeluaran;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::count();
        $jeniszis = JenisZis::count();
        $pengeluaran = Pengeluaran::all()->sum('nominal');
        $pemasukan = Pemasukan::all()->sum('nominal');
        return view('home',['user'=>$user,'jeniszis'=>$jeniszis,'pengeluaran'=>$pengeluaran,'pemasukan'=>$pemasukan]);
    }
    public function welcome()
    {

        $this->middleware('auth');
        return view('welcome');

    }
}
