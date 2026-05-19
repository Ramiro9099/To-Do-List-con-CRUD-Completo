<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
// Redirige la raiz a la lista de tareas
Route::get('/', fn() => redirect('/tareas'));
// IMPORTANTE: /tareas/create ANTES de /tareas/{id}
Route::get('/tareas', [TareaController::class, 'index']);
Route::get('/tareas/create', [TareaController::class, 'create']);
Route::post('/tareas', [TareaController::class, 'store']);
Route::get('/tareas/{id}/edit', [TareaController::class, 'edit']);
Route::put('/tareas/{id}', [TareaController::class, 'update']);
Route::delete('/tareas/{id}', [TareaController::class, 'destroy']);