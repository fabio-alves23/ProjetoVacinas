    <?php 

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\PetController;
    use App\Http\Controllers\VacinaController;
    use App\Http\Controllers\PetVacinaController;
    use App\Http\Controllers\AgendamentoDeVacinaController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\ConfiguracaoController;
    use App\Http\Controllers\CargosController;

    // Rotas públicas
    Route::get('/configuracoes', [ConfiguracaoController::class, 'index']);
    Route::post('/configuracoes', [ConfiguracaoController::class, 'updateOrCreate']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Rotas protegidas
    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);

        // Usuário
        Route::get('/usuario', [UserController::class, 'show']);
        Route::put('/usuario', [UserController::class, 'update']);
        Route::delete('/usuario', [UserController::class, 'destroy']);

        // Pets
        Route::apiResource('pets', PetController::class);

        // Vacinas
        Route::apiResource('vacinas', VacinaController::class);

        // Vacinas aplicadas em pets
        Route::get('pets/{pet}/vacinas', [PetVacinaController::class, 'index']);
        Route::post('pets/{pet}/vacinas', [PetVacinaController::class, 'store']);
        Route::delete('/petvacinas/{id}', [PetVacinaController::class, 'destroy']);
        Route::put('/petvacinas/{id}', [PetVacinaController::class, 'update']);

        // Pets excluídos
        Route::get('/pets/deleted', [PetController::class, 'deleted']);
        Route::patch('/pets/{id}/restore', [PetController::class, 'restore']);
        Route::delete('/pets/{id}/force', [PetController::class, 'forceDelete']);

        // Relatório de atrasados
        Route::get('/agendamentos-de-vacinas/relatorio-atrasadas', [AgendamentoDeVacinaController::class, 'relatorioAtrasadas']);

        // Agendamento de vacinas
        Route::apiResource('agendamento-de-vacinas', AgendamentoDeVacinaController::class);

        // Cargos
        Route::apiResource('cargos', CargosController::class);

        // Setar permissões no cargo
        Route::post('/cargos/{cargo}/permissoes', [CargosController::class, 'setPermissoes']);
    });
