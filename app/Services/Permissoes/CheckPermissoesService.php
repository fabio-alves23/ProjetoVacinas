<?php

namespace App\Services\Permissoes;

use App\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Gate;

class CheckPermissoesService
{
    public function run($ability)
    {
        $roleHasPermission = Gate::inspect($ability);

        if ($roleHasPermission->denied()) {
            throw new UnauthorizedException();
        }
    }
}
