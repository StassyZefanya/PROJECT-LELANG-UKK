<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\barang;
use App\Models\User;
use App\Models\Historylelang;
class lelang extends Model
{
    use HasFactory;
    protected $table  = 'lelangs';
    protected $fillable = [
        'barangs_id',
        'users_id',
        'tanggal',
        'harga_akhir',
        'pemenang',
        'status'
    ];
    public function barang()
    {
        return $this->hasOne('App\Models\barang', 'id', 'barangs_id');
    }
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'users_id');
    }
    public function historylelang()
    {
        return $this->belongsTo(Historylelang::class);
    }
}