<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';
    
    protected $fillable = [
        'id_pesanan',
        'id_pengguna',
        'total',
        'tunai',
        'kembali',
    ];

    public $timestamps = false;

    public function pesanan()
    {
        return $this->hasOne(Pembayaran::class, 'id_pesanan', 'id_pembayaran');
    }
}
