<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'barang_masuk';


    public function pemesanan_admin()
    {
        return $this->belongsTo(PemesananKonsumen::class);
    }
    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'data_barang_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
