<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task; //importar el modelo Task
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
    $tasks = Task::paginate(3); // Obtiene todas las tareas
    return view('index', ['tasks' => $tasks]); // Pasa las tareas a la vista
});

Route::resource("tasks", TaskController::class);    