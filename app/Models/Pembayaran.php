<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    
    protected $fillable = [
        'total_harga',
        'uang_bayar',
        'uang_kembali',
    ];

    public $timestamps = false;
}
