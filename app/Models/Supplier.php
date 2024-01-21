<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function data_barang()
    {
        return $this->hasMany(DataBarang::class);
    }

    public function pemesanan_admin()
    {
        return $this->hasMany(PemesananAdmin::class);
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'supplier_id');
    }
}
