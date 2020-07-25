<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PemasukanBentuk extends Model
{
    use Sortable;

    protected $table = 'pemasukan_bentuk';
    protected $primaryKey = 'id';
    protected $fillable = ['bentuk_id','tanggal','user_id','note'];
    protected $casts = ['tanggal'=>'date'];

    public $sortable = ['bentuk_id','tanggal','user_id','note','created_at'];

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
    public function bentukzis() {
        return $this->belongsTo('App\BentukZis', 'bentuk_id');
    }
}
