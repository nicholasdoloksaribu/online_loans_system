<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;
    public $table = "document";
    protected $fillable = [
        'foto_ktp',
        'bukti_lainnya',
    ];
}
