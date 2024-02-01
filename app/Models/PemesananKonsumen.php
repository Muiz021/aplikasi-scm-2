<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananKonsumen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pemesanan_konsumen';


    public function barang_masuk()
    {
        return $this->hasOne(BarangMasuk::class, 'id', 'barang_masuk_id');
    }

    public function pembayaran_konsumen()
    {
        return $this->hasOne(PembayaranKonsumen::class,'id','id');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class);
    }
}
