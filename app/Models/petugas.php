<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    use HasFactory;

    protected $fillable =[
        'id_petugas',
        'username',
        'password',
        'nama_petugas',
        'type'
    ];
}
