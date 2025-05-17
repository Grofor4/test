<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisObat extends Model
{
    protected $table = 'jenis_obat';

    protected $fillable = [
        'jenis',
        'deskripsi_jenis',
        'image_url'
    ];

    public function obat()
    {
        return $this->hasMany(Obat::class, 'id_jenis_obat');
    }
}
