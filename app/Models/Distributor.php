<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'distributor';

    protected $fillable = [
        'nama_distributor',
        'telepon',
        'alamat'
    ];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id_distributor');
    }
}
