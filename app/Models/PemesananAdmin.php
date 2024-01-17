<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananAdmin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pemesanan_admin';

    // public function pemesanan_admin_detail()
    // {
    //     return $this->hasMany(PemesananAdminDetail::class,'pemesanan_admin_id','id');
    // }

    public function data_barang()
    {
        return $this->hasOne(DataBarang::class,'id','data_barang_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
