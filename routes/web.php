<?php


use App\Http\Controllers\API\PokemonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [PokemonController::class, 'index']);
Route::get('/pokemon/{id}', [PokemonController::class, 'show'])->name('pokemon.show');

