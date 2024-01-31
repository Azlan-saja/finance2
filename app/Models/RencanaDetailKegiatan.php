<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class RencanaDetailKegiatan extends Model
{
    use HasFactory;
    protected $table = 'rencanadetailkegiatan';
    protected $fillable = [
        'rencana_id',
        'rencana_detail_id',
        'rencana_detail_subbagian_id',
        'subbagian_id',
        'nama_kegiatan',
        'sasaran',
        'anggaran',
        'satuan',
        'jumlah_sasaran',
        'volume',
        'harga',
    ];
    
 
    protected $appends = [
        'total',
        // 'grandtotal',
    ];    
    // protected function grandtotal(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) =>  number_format($value,0,",","."),            
    //     );
    // }
    protected function total(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  number_format($this->volume * str_replace('.','',$this->harga),0,",","."),
        );
    }

    protected function harga(): Attribute
    {
        return new Attribute(
            set: fn ($value) =>  str_replace('.','',$value),
            get: fn ($value) =>  number_format($value,0,",","."),
        );
    }
}
