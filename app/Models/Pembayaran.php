<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'pembayarans';

    public function pemesanan_admin()
    {
        return $this->belongsTo(PemesananAdmin::class);
    }
}
