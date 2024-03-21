<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $fillable = ['id_transaksi','id_menu','jumlah','subtotal'];

    public function menu(){
        return $this->hasOne(Menu::class,'id', 'id_menu');
    }

    public function transaksi()
    {
        return $tihs->belongsTo(Transaksi::class, 'id_transaksi');
    }
}
