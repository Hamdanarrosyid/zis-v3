<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    protected $table = 'jamaah';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','jenis_kelamin_id','tempat_lahir','tanggal_lahir','dasa_wisma_id','rt_id','warga_id','golongan_darah_id','keterangan'];

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }
    public function dasaWisma()
    {
        return $this->belongsTo(DasaWisma::class);
    }
    public function rt()
    {
        return $this->belongsTo(RT::class);
    }
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarah::class);
    }
}

