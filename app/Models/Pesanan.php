<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    
    protected $table = 'pesanan';

    protected $primaryKey = 'id_pesanan';
    
    protected $fillable = [
        'nama_pelanggan',
        'tanggal_pesanan',
    ];

    public $timestamps = false;

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
