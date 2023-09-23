<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tpsrw extends Model
{
    use HasFactory;
    protected $fillable = [
        'kelurahan_id',
        'tps',
        'totdpt',
        'dptl',
        'dptp',
        'lokasi',
        'target'
    ];

    protected $dates = ['created_at'];

    public function kelurahans()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function koordinators()
    {
        return $this->belongsToMany(Korcam::class, 'koordinator_tpsrws', 'tpsrw_id', 'koordinator_id');
    }

    public function korhans()
    {
        return $this->belongsToMany(Korhan::class, 'korhan_tps', 'tpshan_id', 'korhan_id');
    }

    public function kortps()
    {
        return $this->belongsToMany(KorTps::class, 'pivot_tps', 'tps_id', 'kortps_id');
    }

    public function anggotas(){
        return $this->belongsTo(Anggota::class, 'id', 'tpsrw_id');

    }
    
    public function konstituante()
    {
        return $this->hasMany(Anggota::class, 'tpsrw_id', 'id')->where('deleted', 0);
    }

}
