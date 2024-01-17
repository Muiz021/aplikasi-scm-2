<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerekBarang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'merek_barang';

    /**
     * relasi
     */
    public function data_barang()
    {
        return $this->belongsTo(DataBarang::class,'id');
    }
}
