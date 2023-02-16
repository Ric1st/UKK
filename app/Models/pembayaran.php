<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $fillable =[
        'id_petugas',
        'nisn',
        'id_spp',
        'jumlah_bayar'
    ];
}
