<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;

class Realisasi extends Model
{
    use HasFactory;

    protected $table = 'realisasi';
    protected $fillable = [
        'rencana_id',
        'rencana_detail_id',
        'rencana_detail_subbagian_id',
        'rencana_detail_kegiatan_id',
        'subbagian_id',
        'bagian_id',
        'b1',
        'b2',
        'b3',
        'b4',
        'b5',
        'b6',
        'b7',
        'b8',
        'b9',
        'b10',
        'b11',
        'b12',
    ];
  
    public function kegiatans(): HasOne
    {
        return $this->hasOne(RencanaDetailKegiatan::class,'id', 'rencana_detail_kegiatan_id');
    }
}
