<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <-- obrigatório para tokens
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes; 

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function cargos()
{
    return $this->belongsToMany(Cargos::class);
}

public function hasCargo($nomeCargo)
{
    return $this->cargos()->where('nome', $nomeCargo)->exists();
}

}


