<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    use HasFactory;

    protected $fillable = ['image','birth_certificate','name','gender','phone','age','address','user_id','longitude','latitude',
        'is_lost'];
}
