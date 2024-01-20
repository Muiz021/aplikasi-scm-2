<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'barang_masuk';

    /**
     * Relasi
     */

     public function supplier()
     {
        return $this->hasOne(Supplier::class,'id','supplier_id');
     }

     public function data_barang()
     {
        return $this->hasOne(DataBarang::class,'id','data_barang_id');
     }


}
