<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemesananAdmin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pemesanan_admin';


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
