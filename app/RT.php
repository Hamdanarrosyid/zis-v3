<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    protected $table = 'rt';
    protected $primaryKey = 'id';
    protected $fillable = ['nomor_rt'];
}
