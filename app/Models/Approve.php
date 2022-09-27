<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approve extends Model
{
    use HasFactory;
    protected $table = 'approve_payment';
    protected $primaryKey = 'id_approve';
    protected $fillable = [
        'id_invoice',
        'nama_pengirim',
        'bukti_bayar',
        'tgl_bayar'
    ];
}
