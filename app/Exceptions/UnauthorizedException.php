<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    public function __construct(
        string $message = "Você não tem permissão para realizar esta ação.",
        int $code = 403
    ) {
        parent::__construct($message, $code);
    }
}
