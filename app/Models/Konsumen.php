<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Relasi
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pemesanan_konsumen()
    {
        return $this->hasMany(PemesananKonsumen::class);
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }
}
