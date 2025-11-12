<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // adicione isto
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetVacina extends Model
{
    use HasFactory, SoftDeletes; // adicione HasFactory aqui

    protected $fillable = [
        'pet_id', 'vacina_id', 'data_aplicacao', 'data_proxima_dose',
    ];

    public function pet()
    {
        return $this->belongsTo(\App\Models\Pet::class);
    }

    public function vacina()
    {
        return $this->belongsTo(\App\Models\Vacina::class);
    }
}


