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
        'dptp'
    ];

    protected $dates = ['created_at'];

    public function kelurahans()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function koordinators()
    {
        return $this->belongsToMany(Koordinator::class, 'koordinator_tpsrw', 'tpsrw_id', 'koordinator_id');
    }
}
