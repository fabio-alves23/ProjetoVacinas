<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cargos\StoreCargosRequest;
use App\Http\Requests\Cargos\UpdateCargosRequest;
use App\Http\Resources\CargosResource;
use App\Models\Cargos;
use App\Services\Cargos\DeleteCargosService;
use App\Services\Cargos\IndexCargosService;
use App\Services\Cargos\StoreCargosService;
use App\Services\Cargos\UpdateCargosService;

class CargosController extends Controller
{
    public function index(IndexCargosService $service)
    {
        $cargos = $service->run();
        return CargosResource::collection($cargos);
    }

    public function store(StoreCargosRequest $request, StoreCargosService $service)
    {
        $cargo = $service->run($request->validated());
        return new CargosResource($cargo);
    }

    public function update(UpdateCargosRequest $request, Cargos $cargos, UpdateCargosService $service)
    {
        $cargos = $service->run($request->validated(), $cargos);
        return new CargosResource($cargos);
    }

    public function destroy($id, DeleteCargosService $service)
    {
        $service->run($id);
        return response()->json([], 204);
    }
}
