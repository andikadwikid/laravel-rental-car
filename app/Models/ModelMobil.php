<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMobil extends Model
{
    use HasFactory;

    protected $table = 'model_mobils';
    protected $fillable = [
        'nama'
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id', 'model');
    }
}
