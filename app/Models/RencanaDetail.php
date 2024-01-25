<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RencanaDetail extends Model
{
    use HasFactory;

    protected $table = 'rencanadetail';
    protected $fillable = ['rencana_id','bagian_id','nama_bagian'];


}
