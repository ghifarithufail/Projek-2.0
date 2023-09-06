<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabkota extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kabkota',
        'provinsi'
    ];

    protected $dates = ['created_at'];

    public function biodatas()
    {
        return $this->belongsTo(Biodata::class);
    }
}
