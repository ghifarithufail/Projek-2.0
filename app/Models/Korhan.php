<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korhan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'nama_koordinator',
        'phone',
        'nik',
        'nokk',
        'kabkota_id',
        'tgl_lahir',
        'alamat',
        'rt',
        'rw',
        'kelurahan_id',
        'status',
        'keterangan',
        // 'user_id'  ,
        'kelurahan_id',
        'korcam_id',
        'tps_id'
    ];

    public function kelurahans()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function koordinators()
    {
        return $this->belongsTo(Korcam::class, 'korcam_id', 'id');
    }

    public function kabkotas()
    {
        return $this->belongsTo(Kabkota::class, 'kabkota_id', 'id');
    }

    public function kortps()
    {
        return $this->belongsTo(KorTps::class, 'id', 'korhan_id');
    }

    public function pivot_korhans()
    {
        return $this->belongsToMany(Tpsrw::class, 'korhan_tps', 'korhan_id', 'tps_id');
    }
}
