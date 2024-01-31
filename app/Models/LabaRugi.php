<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class LabaRugi extends Model
{
    use HasFactory;

    protected function unit(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["RA", "SD", "SMP", "YYS"][$value],
        );
    }

}
