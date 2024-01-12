<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
// use Kyslik\ColumnSortable\Sortable;

class Bagian extends Model
{
    use HasFactory;//, Sortable;

    
    protected $table = 'bagian';
    protected $fillable = ['type','bagian'];
    // protected $appends = ['typeOF'];

    // public $sortable = ['type', 'bagian'];

    
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["RA", "SD", "SMP", "YYS"][$value],
        );
    }
    
}
