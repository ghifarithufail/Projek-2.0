<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'nama_kelurahan',
        'kecamatan',
        'dapil',
        'kabkota',
        'provinsi',
        'kode_kel',
    ];

    
    public function korhans(){
        return $this(Korhan::class, 'id', 'kelurahan_id');
    }

    public function tpsrws()
    {
        return $this->belongsTo(Tpsrw::class,'id', 'kelurahan_id' );
    }


}
