<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';
    protected $fillable = ['unit','nama','sumber','nominal','tanggal','tahun'];

    protected function nominal(): Attribute
    {
        return new Attribute(
            set: fn ($value) =>  str_replace('.','',$value),
            get: fn ($value) =>  number_format($value,0,",","."),
        );
    }

    protected function unit(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["RA", "SD", "SMP", "YYS"][$value],
        );
    }
}
