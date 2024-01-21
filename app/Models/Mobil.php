<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobils';
    protected $fillable = [
        'merk',
        'model',
        'no_plat',
        'tarif'
    ];

    public function merk()
    {
        return $this->hasMany(Merk::class, 'id', 'merk');
    }

    public function model()
    {
        return $this->hasMany(ModelMobil::class, 'id', 'model');
    }
}
