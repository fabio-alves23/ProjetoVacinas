<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;

class PetPolicy
{
    /**
     * Apenas o dono do pet ou admin pode visualizar.
     */
    public function view(User $user, Pet $pet)
    {
        return $user->id === $pet->user_id || $user->is_admin;
    }

    /**
     * Qualquer usuário autenticado pode criar.
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Apenas o dono do pet ou admin pode atualizar.
     */
   public function update(User $user, Pet $pet)
{
    return $user->id === $pet->user_id;
}

    /**
     * Apenas o dono do pet ou admin pode deletar.
     */
   public function delete(User $user, Pet $pet)
{
    return $user->id === $pet->user_id;
}
}
