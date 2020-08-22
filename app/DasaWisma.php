<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DasaWisma extends Model
{
    protected $table = 'dasa_wisma';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_dasa_wisma','jumlah_krt','jumlah_kk'];
}
