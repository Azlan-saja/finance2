<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class RencanaDetailSubBagian extends Model
{
    use HasFactory;

    protected $table = 'rencanadetailsubbagian';
    protected $fillable = ['rencana_detail_id','subbagian_id','nama_subbagian'];

    

}
