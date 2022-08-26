<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'review';
    protected $primaryKey = 'id_review';
    protected $fillable = [
        'id_reviewer',
        'id_artikel',
        'catatan',
        'tgl_review'
    ];
}
