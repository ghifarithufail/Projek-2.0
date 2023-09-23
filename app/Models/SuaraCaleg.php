<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuaraCaleg extends Model
{
    use HasFactory;
    protected $fillable = [
        'tpsrw_id',
        'caleg_id',
        'suara_caleg',
        'partai_id',
        'dpr_ri',
        'dpr_prov',
        'dprd',
        'photo',
        'keterangan',
        'user_id',
    ];

    public function tpsrws()
    {
        return $this->belongsTo(Tpsrw::class,'tpsrw_id','id' );
    }

    public function calegs()
    {
        return $this->belongsTo(Caleg::class, 'caleg_id','id' );
    }

    public function partais()
    {
        return $this->belongsTo(Partai::class,'partai_id','id' );
    }
}
