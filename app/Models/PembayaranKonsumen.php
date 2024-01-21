<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranKonsumen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = ['pembayaran_konsumen'];

    public function pemesanan_konsumen()
    {
        return $this->belongsTo(PemesananKonsumen::class);
    }
}
