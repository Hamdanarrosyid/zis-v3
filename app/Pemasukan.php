<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pemasukan extends Model
{
    use Sortable;

    protected $table = 'pemasukan_zis';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis_id','tanggal','nominal','user_id','note','image'];
    protected $casts = ['tanggal'=>'date'];

    public $sortable = ['jenis_id','tanggal','nominal','user_id','note','created_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function jeniszis() {
        return $this->belongsTo('App\JenisZis', 'jenis_id');
    }
    public function getMonthYear()
    {
        return $this->attributes['tanggal'] = '2001-07-09';
    }
}

