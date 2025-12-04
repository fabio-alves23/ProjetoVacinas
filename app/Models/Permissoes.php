<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permissoes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'permissoes';

    protected $fillable = [
        'name',
        'description',
    ];

    public function cargos() : BelongsToMany
    {
        return $this->belongsToMany(Cargos::class);
    }
}
