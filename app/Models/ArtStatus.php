<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtStatus extends Model
{
    use HasFactory;
    protected $table = 'artikel_status';
    protected $primaryKey = 'id_artikel_status';
    protected $fillable = [
        'kode_status',
        'id_artikel',
        'tanggal'
    ];
}
