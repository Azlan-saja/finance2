<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubBagian extends Model
{
    use HasFactory;

    protected $table = 'subbagian';
    protected $fillable = ['bagian_id','subbagian'];

    public function bagians(): BelongsTo
    {
        return $this->belongsTo(Bagian::class, 'bagian_id');
    }
}
 