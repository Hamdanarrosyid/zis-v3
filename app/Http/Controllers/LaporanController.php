<?php

namespace App\Http\Controllers;

use App\JenisZis;
use App\Laporan;
use App\Pemasukan;
use App\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use function MongoDB\BSON\toJSON;
use function Sodium\compare;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;
        $page = $request->get('page') ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = JenisZis::all()->mapToGroups(function ($jenisZis) {
            $jenis_id = $jenisZis->id;
            $pemasukan = Pemasukan::sortable()->where('jenis_id', '=', $jenisZis->id)->sum('nominal');
            $pengeluaran = Pengeluaran::where('jenis_id', '=', $jenisZis->id)->sum('nominal');
            $saldo = $pemasukan - $pengeluaran;
            return [$jenisZis->jenis => compact(['pemasukan', 'pengeluaran', 'saldo', 'jenis_id'])];
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
        return response()->view('laporan.index', ['pemasukan' => $pemasukan, 'totalm' => $totalm, 'totalk' => $totalk, 'totals' => $totals, 'no' => $no]);
    }

    public function chart()
    {
        $jeniszis = JenisZis::all();
        $data = $jeniszis->mapToGroups(function ($jenis) {
            $pemasukan = Pemasukan::where('jenis_id', '=', $jenis->id)->sum('nominal');
            $pengeluaran = Pengeluaran::where('jenis_id', '=', $jenis->id)->sum('nominal');
            $saldo = $pemasukan - $pengeluaran;
            return [$jenis->jenis => $saldo];
        })->map(function ($item) {
            return $item->first();
        });
        return response()->json($data);
    }

    protected $filter_value = null;

    public function masuk_show(JenisZis $jenis)
    {
        $hasil_data = Pemasukan::where('jenis_id', '=', $jenis->id)->paginate(10);
        $data = Pemasukan::all()->where('jenis_id', '=', $jenis->id);
        $min_month = $data->min('tanggal');
        $max_month = $data->max('tanggal');

        return view('laporan.show-masuk', ['hasil_data' => $hasil_data, 'jenis' => $jenis, 'min_month' => $min_month, 'max_month' => $max_month, 'filter_value' => $this->filter_value]);
    }

    public function keluar_show(JenisZis $jenis)
    {
        $hasil_data = Pengeluaran::where('jenis_id', '=', $jenis->id)->paginate(10);
        $data = Pengeluaran::all()->where('jenis_id', '=', $jenis->id);
        $min_month = $data->min('tanggal');
        $max_month = $data->max('tanggal');

        return view('laporan.show-keluar', ['hasil_data' => $hasil_data, 'jenis' => $jenis, 'min_month' => $min_month, 'max_month' => $max_month, 'filter_value' => $this->filter_value]);
    }

    public function masuk_filter(Request $request, JenisZis $jenis)
    {
        return $this->filter('pemasukan', $request, $jenis, 'masuk');
    }

    public function keluar_filter(Request $request, JenisZis $jenis)
    {
        $pengeluaran = 'pengeluaran';
        return $this->filter($pengeluaran, $request, $jenis, 'keluar');
    }

    public function filter($model, $date_request, $jenis, $view)
    {
        $this->validate($date_request,[
            'filter'=>['required', 'date']
        ]);
        $date = strtotime($date_request->filter);
        $year = date('Y', $date);
        $month = date('m', $date);
        $this->filter_value = $date_request->filter;

        if ($model == 'pemasukan') {
            $data = Pemasukan::all()->where('jenis_id', '=', $jenis->id);
            $min_month = $data->min('tanggal');
            $max_month = $data->max('tanggal');
            $hasildata = Pemasukan::where('jenis_id', '=', $jenis->id)->whereYear('tanggal', '=', $year)->whereMonth('tanggal', '=', $month)->paginate(10)->appends('filter', $this->filter_value);
        }
        else if ($model == 'pengeluaran'){
            $data = Pengeluaran::all()->where('jenis_id', '=', $jenis->id);
            $min_month = $data->min('tanggal');
            $max_month = $data->max('tanggal');
            $hasildata = Pengeluaran::where('jenis_id', '=', $jenis->id)->whereYear('tanggal', '=', $year)->whereMonth('tanggal', '=', $month)->paginate(10)->appends('filter', $this->filter_value);
        }

        return response()->view("laporan.show-".$view, ['hasil_data' => $hasildata, 'jenis' => $jenis, 'min_month' => $min_month, 'max_month' => $max_month, 'filter_value' => $this->filter_value]);
    }
}
