<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bagian extends Model
{
    use HasFactory;

    
    protected $table = 'bagian';
    protected $fillable = ['bagian'];

    public function subbagians(): HasMany
    {
        return $this->hasMany(SubBagian::class);
    }

    // protected $appends = [
    //     'lvl'
    // ];

    // protected function lvl(): Attribute
    // {
    //     switch ($this->type) {
    //     case 'RA':
    //         $z = 0;
    //         break;
    //     case 'SD':
    //         $z = 1;
    //         break;
    //     case 'SMP':
    //         $z = 2;
    //         break;
    //     case 'YYS':
    //         $z = 3;
    //         break;
    //     default:
    //        $z = 5;
    //     }        
    //     return new Attribute(
    //         get: fn ($value) =>  $z,
    //     );

    // }
    
    // protected function type(): Attribute
    // {        
    //     return new Attribute(
    //         get: fn ($value) =>  ["RA", "SD", "SMP", "YYS"][$value],
    //     );
    // }
    
}
