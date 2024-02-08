<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'barang_keluar';

    public function barang_masuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_masuk_id');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class);
    }
}
