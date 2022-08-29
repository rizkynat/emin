<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $primaryKey = 'id_invoice';
    protected $fillable = [
        'id_artikel',
        'no_invoice',
        'tgl_invoice'
    ];
}
