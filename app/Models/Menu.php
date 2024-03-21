<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne; // Import Hubungan HasOne

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $fillable = ['jenis_id', 'nama_menu', 'harga', 'image', 'deskripsi'];

    public function jenis(){
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }

    public function stok(): HasOne // Tipe pengembalian yang diperbaiki
    {
        return $this->hasOne(Stok::class, 'menu_id', 'id');
    }
}

