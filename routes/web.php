<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatBotController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/spanish', function () {
    return view('welcome-spanish');
});

Route::match(['get', 'post'], '/botman', [ChatBotController::class,'handle']);
Route::get('/botman/tinker', [ChatBotController::class,'tinker']);

