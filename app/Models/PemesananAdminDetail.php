<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananAdminDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'detail_pemesanan_admin';

    /**
     * relasi
     */
    public function data_barang()
    {
        return $this->hasOne(DataBarang::class,'id','data_barang_id');
    }

    public function pemesanan_admin()
    {
        return $this->belongsTo(PemesananAdmin::class,'id');
    }
}
