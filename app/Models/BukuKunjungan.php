<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuKunjungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama',
        'kelas',
        'keperluan'
    ];

}
