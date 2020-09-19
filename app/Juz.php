<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Juz extends Model
{
    use Sortable;

    protected $table = 'juz';
    protected $primaryKey = 'id';
    protected $fillable = ['juz'];

    public $sortable = ['juz'];
}
