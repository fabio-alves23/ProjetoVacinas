<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargos extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nome',
        'description'
    ];
    
    public function users()
        {
            return $this->belongsToMany(User::class);
        }

    public function Permissoes()
        {
            return $this->belongsToMany(Permissoes::class, 'permissoes_cargos', 'cargos_id','permissoes_id');
        }    
    
}
