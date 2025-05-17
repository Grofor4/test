<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';

    protected $fillable = [
        'nama_obat',
        'id_jenis_obat',
        'harga_jual',
        'deskripsi_obat',
        'foto1',
        'foto2',
        'foto3',
        'stok'
    ];

    public function jenisObat()
    {
        return $this->belongsTo(JenisObat::class, 'id_jenis_obat');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_obat');
    }

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'id_obat');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_obat');
    }
}
