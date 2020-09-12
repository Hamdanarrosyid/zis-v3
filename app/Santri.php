<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table = 'santri';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_santri','tempat_lahir','tanggal_lahir','jenis_kelamin_id','sekolah_id','tingkat_baca','nilai_id'];

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }
}
