<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nokk',
        'nama_anggota',
        'kabkota_id',
        'tgl_lahir',
        'alamat',
        'rt',
        'rw',
        'tpsrw_id',
        'phone',
        'status',
        'keterangan',
        'koordinator_id',
        'verified',
    ];

    public function kabkotas()
    {
        return $this->belongsTo(Kabkota::class, 'kabkota_id', 'id');
    }

    public function tps()
    {
        return $this->belongsTo(Tpsrw::class, 'tpsrw_id', 'id');
    }

    public function koordinators()
    {
        return $this->belongsTo(KorTps::class, 'koordinator_id', 'id');
    }
}
