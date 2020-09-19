<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pencapaian extends Model
{
    use Sortable;

    protected $table = 'pencapaianbaca';
    protected $primaryKey = 'id';
    protected $fillable = ['tingkatbaca_id','nomor_pencapaian'];

    public $sortable = ['nomor_pencapaian'];

    public function tingkatbaca()
    {
       return $this->belongsTo(Tingkatbaca::class);
    }
}
