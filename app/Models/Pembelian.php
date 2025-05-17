<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';

    protected $fillable = [
        'nonota',
        'tgl_pembelian',
        'total_bayar',
        'id_distributor'
    ];

    protected $casts = [
        'tgl_pembelian' => 'date'
    ];

    public function distributor()
    {
        return $this->belongsTo(Distributor::class, 'id_distributor');
    }

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'id_pembelian');
    }
}
