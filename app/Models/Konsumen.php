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
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
