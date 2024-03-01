<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/skill/list', [SkillController::class, 'index']);
Route::post('/skill/store', [SkillController::class, 'store']);
Route::put('/skill/update/{id}', [SkillController::class, 'update']);
Route::delete('/skill/destroy/{id}', [SkillController::class, 'destroy']);

Route::get('/job/list', [JobController::class, 'index']);
Route::post('/job/store', [JobController::class, 'store']);
Route::put('/job/update/{id}', [JobController::class, 'update']);
Route::delete('/job/destroy/{id}', [JobController::class, 'destroy']);

Route::post('/apply', [CandidateController::class, 'apply']);
