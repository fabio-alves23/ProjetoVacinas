<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cargos\StoreCargosRequest;
use App\Http\Requests\Cargos\UpdateCargosRequest;
use App\Http\Requests\Cargos\SetPermissoesRequest;
use App\Http\Resources\CargosResource;
use App\Models\Cargos;

use App\Services\Cargos\DeleteCargosService;
use App\Services\Cargos\IndexCargosService;
use App\Services\Cargos\StoreCargosService;
use App\Services\Cargos\UpdateCargosService;
use App\Services\Cargos\SetPermissoesService;

use App\Services\Permissoes\CheckPermissoesService;

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

    public function update(UpdateCargosRequest $request, Cargos $cargo, UpdateCargosService $service)
    {
        $cargo = $service->run($request->validated(), $cargo);
        return new CargosResource($cargo);
    }

    public function destroy($id, DeleteCargosService $service)
    {
        $service->run($id);
        return response()->json([], 204);
    }

    public function setPermissoes(
        SetPermissoesRequest $request,
        Cargos $cargo,
        SetPermissoesService $service,
        CheckPermissoesService $checkPermissoesService
    ) {
        // verifica se o usuário tem permissão
        $checkPermissoesService->run('cargo.setPermissoes');

        // aplica as permissões ao cargo
        $cargo = $service->run($request->validated(), $cargo);

        return response()->json($cargo);
    }
}
