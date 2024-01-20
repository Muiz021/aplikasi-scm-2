<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'data_barang';

    /**
     * relasi tabel
     */
    public function jenis_barang()
    {
        return $this->hasOne(JenisBarang::class,'id','jenis_barang_id');
    }

    public function merek_barang()
    {
        return $this->hasOne(MerekBarang::class,'id','merek_barang_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function barang_masuk()
    {
       return $this->belongsTo(BarangMasuk::class);
    }


    // public function datail_pemesanan_barang()
    // {
    // return $this->belongsTo(PemesananAdminDetail::class);
    // }

    public function pemesanan_admin()
    {
    return $this->belongsTo(PemesananAdmin::class);
    }
}
