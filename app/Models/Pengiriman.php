<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';

    protected $fillable = [
        'id_penjualan',
        'no_invoice',
        'tgl_kirim',
        'tgl_tiba',
        'status_kirim',
        'nama_kurir',
        'telpon_kurir',
        'bukti_foto',
        'keterangan'
    ];

    protected $casts = [
        'tgl_kirim' => 'datetime',
        'tgl_tiba' => 'datetime'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }
}
