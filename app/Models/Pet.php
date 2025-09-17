<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
 protected $fillable = [
    'user_id',
    'name',
    'species',
    'breed',
    'birthdate',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function petVacinas()
    {
        return $this->hasMany(PetVacina::class);
    }
}
