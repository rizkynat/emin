<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LOA extends Model
{
    use HasFactory;
    protected $table = 'loa';
    protected $primaryKey = 'id_loa';
    protected $fillable = [
        'id_artikel',
        'tgl_loa'
    ];
}
