<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSewa extends Model
{
    use HasFactory;

    protected $table = 'transaksi_sewas';
    protected $guarded = [];
}
