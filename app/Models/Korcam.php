<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korcam extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [];

    protected $dates = ['created_at'];

    public function kelurahans()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function kabkotas()
    {
        return $this->belongsTo(Kabkota::class, 'kabkota_id', 'id');
    }

    public function tpsrws()
    {
        return $this->belongsToMany(Tpsrw::class, 'koordinator_tpsrw', 'koordinator_id', 'tpsrw_id');
    }
}
