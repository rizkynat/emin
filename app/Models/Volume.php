<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'volume';
    protected $primaryKey = 'id_volume';
    protected $fillable = [
        'id_bank',
        'tahun',
        'no_volume',
        'harga'
    ];
}
