<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'barang_masuk';

    public function data_barang()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_masuk_id');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'konsumen_id');
    }
}
