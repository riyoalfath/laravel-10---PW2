<?php

use App\Http\Controllers\Api\MahasiswaController;
use App\Models\Mahasiswa;
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

// Route::get('buku', [BukuController::class,'index']);
// Route::get('buku/{id}', [BukuController::class, 'show']);
// Route::post('buku', [BukuController::class,'store']);
// Route::put('buku/{id}', [BukuController::class,'update']);
// Route::delete('buku/{id}', [BukuController::class,'destroy']);

// Route::apiResource('buku', BukuController::class);
Route::get('/mahasiswa', [MahasiswaController::class,'index']);
Route::get('/average-ipk', [MahasiswaController::class, 'averageIpk']);
Route::get('/average-suliet', [MahasiswaController::class, 'averageSuliet']);
Route::get('/highest-ipk', [MahasiswaController::class, 'highestIpk']);
Route::get('/lowest-ipk', [MahasiswaController::class, 'lowestIpk']);
Route::get('/highest-suliet', [MahasiswaController::class, 'highestSuliet']);
Route::get('/lowest-suliet', [MahasiswaController::class, 'lowestSuliet']);
Route::get('/aggregate-predicates', [MahasiswaController::class, 'aggregatePredicates']);
Route::get('/aggregate-study-duration', [MahasiswaController::class, 'aggregateStudyDuration']);
Route::get('/student-ages', [MahasiswaController::class, 'studentAges']);