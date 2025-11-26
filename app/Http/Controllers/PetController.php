<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Pet\StorePetRequest;
use App\Http\Requests\Pet\UpdatePetRequest;
use App\Http\Resources\PetResource;
use App\Services\Pet\IndexPetService;
use App\Services\Pet\ShowPetService;
use App\Services\Pet\StorePetService;
use App\Services\Pet\UpdatePetService;
use App\Services\Pet\DeletePetService;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    use AuthorizesRequests;

    public function index(IndexPetService $service, Request $request)
    {
        $pets = $service->run($request);
        return PetResource::collection($pets);
    }

    public function show(Pet $pet, ShowPetService $service)
    {
        $pet = $service->run($pet);
        return new PetResource($pet);
    }

    public function store(StorePetRequest $request, StorePetService $service)
    {
        $data = $request->validated();
        $pet = $service->run($data);
        return response(new PetResource($pet), 201);
    }

    public function update(UpdatePetRequest $request, Pet $pet, UpdatePetService $service)
    {
        $this->authorize('update', $pet);
        $data = $request->validated();
        $pet = $service->run($data, $pet);
        return new PetResource($pet);
    }

    public function destroy(Pet $pet, DeletePetService $service)
    {
        $this->authorize('delete', $pet);
        $service->run($pet);
        return response()->json(['message' => 'Pet deletado com sucesso!'], 200);
    }
}
