<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_Review extends Model
{
    use HasFactory;
    protected $table = 'history_review';
    protected $primaryKey = 'id_history_review';
    protected $fillable = [
        'id_review',
        'isi_history',
        'tgl_history'
    ];
}
