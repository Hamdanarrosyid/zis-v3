<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tingkatbaca extends Model
{
    protected $table = 'tingkatbaca';
    protected $primaryKey = 'id';
    protected $fillable = ['tingkat_baca'];
}
