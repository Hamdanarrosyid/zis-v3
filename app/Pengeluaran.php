<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pengeluaran extends Model
{
    use Sortable;

    protected $table = 'pengeluaran_zis';
    protected $primaryKey = 'id';
    protected $fillable = ['keperluan','jenis_id','tanggal','nominal','note','image','user_id'];
    protected $casts = ['tanggal'=>'date'];

    public $sortable = ['keperluan','jenis_id','tanggal','nominal','note','user_id','created_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function nominal(){
        $this->hasMany('nominal');
    }
    public function jeniszis() {
        return $this->belongsTo('App\JenisZis', 'jenis_id');
    }

}
