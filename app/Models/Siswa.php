<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'kelas',
        'alamat',
        'koor_long',
        'koor_lat',
    ];
}
