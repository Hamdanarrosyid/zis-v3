<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Iqro extends Model
{
    use Sortable;

    protected $table = 'iqro';
    protected $primaryKey = 'id';
    protected $fillable = ['jilid'];

    public $sortable = ['jilid'];
}
