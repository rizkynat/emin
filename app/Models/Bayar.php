<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_bayar';
    protected $fillable = [
        'id_invoice',
        'nama_pengirim',
        'bukti_bayar',
        'tgl_bayar'
    ];
}
