<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPengiriman extends Model
{
    protected $table = 'jenis_pengiriman';
    
    protected $fillable = [
        'jenis_kirim',
        'nama_ekspedisi',
        'logo_ekspedisi'
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_jenis_kirim');
    }
}
