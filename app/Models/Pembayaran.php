<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pemesanan_admin()
    {
        return $this->belongsTo(PemesananAdmin::class);
    }
}
