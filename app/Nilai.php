<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Nilai extends Model
{
    use Sortable;

    protected $table = 'nilai';
    protected $primaryKey = 'id';
    protected $fillable = ['nilai'];

    public $sortable = ['nilai'];
}
