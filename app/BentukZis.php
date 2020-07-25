<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BentukZis extends Model
{
    protected $table = 'bentuk_zis';
    protected $primaryKey = 'id';
    protected $fillable = ['bentuk'];
}
