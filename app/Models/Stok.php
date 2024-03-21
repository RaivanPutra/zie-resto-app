<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok';
    protected $fillable = ['menu_id', 'jumlah'];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
