<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MensagemTesteMail;

use App\Http\Controllers\TarefaController;

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
    return view('boas-vindas');
});

Auth::routes(['verify' => true]);

Route::get('tarefa/export/{extensao}', [TarefaController::class, 'export'])
    ->name('tarefa.export');
    
Route::resource('tarefa', 'App\Http\Controllers\TarefaController')
    ->middleware('verified');

Route::get('mensagem-teste', function () {
    return new MensagemTesteMail();
}
);
