<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korcam extends Model
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
        'tpsrw_id'
    ];

    protected $dates = ['created_at'];

    public function kelurahans()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function kabkotas()
    {
        return $this->belongsTo(Kabkota::class, 'kabkota_id', 'id');
    }

    public function korhans()
    {
        return $this->belongsTo(Korhan::class, 'id', 'korcam_id');
    }

    public function tpsrws()
    {
        return $this->belongsToMany(Tpsrw::class, 'koordinator_tpsrws', 'koordinator_id', 'tpsrw_id');
    }

    public function korhansWithDeletedCount()
    {
        return $this->hasMany(Korhan::class)
            ->where('deleted', 0)
            ->selectRaw('count(*) as aggregate');
    }
}
