<?php

namespace App\Http\Controllers;

use App\JenisZis;
use App\Laporan;
use App\Pemasukan;
use App\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use function MongoDB\BSON\toJSON;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;
        $page = $request->get('page') ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = JenisZis::all()->mapToGroups(function ($jenisZis) {
            $pemasukan = Pemasukan::sortable()->where('jenis_id', '=', $jenisZis->id)->sum('nominal');
            $pengeluaran = Pengeluaran::where('jenis_id', '=', $jenisZis->id)->sum('nominal');
            $saldo = $pemasukan - $pengeluaran;
            return [$jenisZis->jenis => compact(['pemasukan', 'pengeluaran', 'saldo'])];
        })->map(function ($data) {
            return $data->first();
        });
        $pemasukan = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => $request->path()
        ]);
        $totalm = $items->sum('pemasukan');
        $totalk = $items->sum('pengeluaran');
        $totals = $items->sum('saldo');
        $no = 0;
        return response()->view('laporan.index', ['pemasukan' => $pemasukan,'totalm'=>$totalm,'totalk'=>$totalk,'totals'=>$totals,'no'=>$no]);
    }
    public function chart()
    {
        $jeniszis = JenisZis::all();
        $data = $jeniszis->mapToGroups(function ($jenis){
            $pemasukan = Pemasukan::where('jenis_id','=',$jenis->id)->sum('nominal');
            $pengeluaran = Pengeluaran::where('jenis_id','=',$jenis->id)->sum('nominal');
            $saldo = $pemasukan - $pengeluaran;
            return [$jenis->jenis => $saldo];
        })->map(function ($item){
            return $item->first();
        });
        return response()->json($data);
    }
}
