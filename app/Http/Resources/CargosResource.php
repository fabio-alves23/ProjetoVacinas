<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CargosResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'nome'      => $this->nome,
            'descricao' => $this->descricao,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
        ];
    }
}
