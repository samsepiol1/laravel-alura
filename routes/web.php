<?php

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/series', [SeriesController::class, 'index']) ->name("listar_series");
Route::get('/series/criar', [SeriesController::class, 'create']) ->name('form_criar_serie');
Route::post('/series/criar', [SeriesController::class, 'store']);
Route::delete('/series/remover/{id}', [SeriesController::class, 'destroy']);
Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index']);
Route::post('/series/{id}/editaNome', [SeriesController::class, 'editaNome']);
Route::get('/temporadas/{temporadaId}/episodios', [EpisodiosController::class, 'index']);
Route::post('/temporada/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
