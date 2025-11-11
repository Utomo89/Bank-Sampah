<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\JenisSampah;
class SetoranSampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_sampah_id',
        'berat',
        'total_harga',
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Jenis Sampah
    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampah::class);
    }
}
