<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KorTps extends Model
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
        'korhan_id',
        'status_karyawan',
        'tps_id'
    ];

    public function kelurahans()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }


    public function korhans()
    {
        return $this->belongsTo(Korhan::class, 'korhan_id', 'id');
    }

    public function kabkotas()
    {
        return $this->belongsTo(Kabkota::class, 'kabkota_id', 'id');
    }

    public function anggotas()
    {
        return $this->belongsTo(Anggota::class, 'id', 'koordinator_id');
    }

    public function tps_pivot()
    {
        return $this->belongsToMany(Tpsrw::class, 'pivot_tps', 'kortps_id', 'tps_id');
    }
    public function anggotasWithDeleted()
    {
        return $this->hasMany(Anggota::class)
            ->where('deleted', 0)
            ->selectRaw('count(*) as aggregate');
    }
}
