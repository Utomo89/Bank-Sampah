<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SetoranSampah;

class JenisSampah extends Model
{
    //
    use HasFactory;

    protected $fillable = ['nama', 'harga_per_kg'];

    // Relasi ke setoran sampah
    public function setoranSampah()
    {
        return $this->hasMany(SetoranSampah::class);
    }
}
