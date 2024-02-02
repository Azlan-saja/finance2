<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rencana extends Model
{
    use HasFactory;

    protected $table = 'rencana';
    protected $fillable = ['anggaran','unit','tahun','status'];
    protected $appends = [
        'lvl'
    ];

    public function rencanadetails(): HasMany
    {
        return $this->hasMany(Rencana::class);
    }

    protected function lvl(): Attribute
    {
        switch ($this->unit) {
        case 'RA':
            $z = 0;
            break;
        case 'SD':
            $z = 1;
            break;
        case 'SMP':
            $z = 2;
            break;
        case 'YYS':
            $z = 3;
            break;
        default:
           $z = 5;
        }        
        return new Attribute(
            get: fn ($value) =>  $z,
        );

    }

    protected function unit(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["RA", "SD", "SMP", "YYS"][$value],
        );
    }

    protected function anggaran(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  number_format($value,0,",","."),
        );
    }

    // public function pemasukans()
    // {
    //     return $this->hasMany(Pemasukan::class, 'tahun', 'tahun');
    // }
    
    // public function pengeluarans()
    // {
    //     return $this->hasMany(Realisasi::class, 'rencana_id');
    // }

    
}
