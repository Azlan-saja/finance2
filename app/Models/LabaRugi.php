<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class LabaRugi extends Model
{
    use HasFactory;

     protected $appends = [
        'vi'
    ];

    protected function vi(): Attribute
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

   

}
