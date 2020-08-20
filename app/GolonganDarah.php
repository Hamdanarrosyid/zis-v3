<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GolonganDarah extends Model
{
    protected $table = 'glongan_darah';
    protected $primaryKey = 'id';
    protected $fillable = ['golongan_darah'];
}
