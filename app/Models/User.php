<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
       
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'lvl'
    ];

    protected function lvl(): Attribute
    {
        switch ($this->type) {
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

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["RA", "SD", "SMP", "YYS"][$value],
        );
    }
}
