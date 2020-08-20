<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    protected $table = 'jenis_kelamin';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis_kelamin'];
}
