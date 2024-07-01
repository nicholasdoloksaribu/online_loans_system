<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $fillable = [
        'customer_id',
        'service_id',
        'tgl_pinjam',
        'tgl_pengembalian',
        'status',
    ];

    public function customer(){
        return $this->belongsTo(Customers::class);
    }
    public function service(){
        return $this->belongsTo(Services::class);
    }
}
