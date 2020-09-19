<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table = 'santri';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_santri','tempat_lahir','tanggal_lahir','jenis_kelamin_id','sekolah_id','tingkatbaca_id','juz_id','iqro_id','nilai_id'];

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
    public function juz()
    {
        return $this->belongsTo(Juz::class);
    }
    public function iqro()
    {
        return $this->belongsTo(Iqro::class);
    }
    public function tingkatbaca()
    {
        return $this->belongsTo(Tingkatbaca::class);
    }
    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }

}
