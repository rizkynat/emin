<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'artikel';
    protected $primaryKey = 'id_artikel';
    protected $fillable = [
        'id_artikel',
        'id_volume',
        'nama_penulis',
        'email_penulis',
        'judul_artikel',
        'instansi'
    ];
}
