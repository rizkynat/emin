<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'reviewer';
    protected $primaryKey = 'id_reviewer';
    protected $fillable = [
        'nama_reviewer',
        'kategori',
        'instansi'
    ];
}
