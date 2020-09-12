<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';
    protected $primaryKey = 'id';
    protected $fillable = ['jenjang_sekolah','nama_sekolah'];
}
