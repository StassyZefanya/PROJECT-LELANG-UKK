<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $fillable = [
        'nama_barang',
        'tanggal',
        'harga_awal',
        'deskripsi'
    ];

    public function lelang()
    {
        return $this->belongsTo(Lelang::class);
    }
}
