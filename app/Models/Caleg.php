<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caleg extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'partai_id',
        'namacaleg',
        'no_urut',
        'jk',
        'kandidat',
        'dapil_id',
        'status',
        'photo',
    ];

    public function dapils()
    {
        return $this->belongsTo(Dapil::class, 'dapil_id', 'id');
    }

    public function partais()
    {
        return $this->belongsTo(Partai::class, 'partai_id', 'id');
    }
}
