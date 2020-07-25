<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisZis extends Model
{
    protected $table = 'jenis_zis';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis'];
}
