<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'jenis_barang';

    /**
     * relasi
     */
    public function data_barang()
    {
        return $this->belongsTo(DataBarang::class,'id');
    }
}
