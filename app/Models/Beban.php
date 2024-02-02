<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Beban extends Model
{
    use HasFactory;

    protected $table = 'beban';
    protected $fillable = ['nama','besaran','masuk','akhir'];

    protected function besaran(): Attribute
    {
        return new Attribute(
            set: fn ($value) =>  str_replace('.','',$value),
            // get: fn ($value) =>  number_format($value,0,",","."),
        );
    }
}
