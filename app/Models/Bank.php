<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'bank';
    protected $fillable = [
        'nama_bank',
        'no_rek',
        'atas_nama',
        'email'
    ];
}
