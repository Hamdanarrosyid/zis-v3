<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juz extends Model
{
    protected $table = 'juz';
    protected $primaryKey = 'id';
    protected $fillable = ['juz'];
}
