<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View; //importar la clase View

class TaskController extends Controller
{

    public function index() : View
    {
        $tasks=Task::latest()->paginate(3); //obtener todos los registros de la base de datos
        return view('index',['tasks' =>$tasks]); //pasar los registros a la vista index.blade.php
    }

    public function create() : View
    {
        return view('create');
    }

    public function store(Request $request): RedirectResponse 
    {
        //dd($request->all()); //probar que se esté recibiendo la información

        $request->validate([ 
            'title'=>'required',
            'description'=>'required'
        ]); //validar que los campos Objetivo y Descripción no estén vacíos

        Task::create($request->all()); //guardar en la base de datos

        return redirect()->route('tasks.index')->with('success','Nuevo objetivo completado'); //redireccionar a la vista principal
    }
 function show(Task $task)
    {
        //
    }

    public function edit(Task $task) : View
    {
        //dd($task); //probar que se esté recibiendo la información
        return view('edit', ['task'=>$task]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        //
        //dd($request->all()); //probar que se esté recibiendo la información
        $request->validate([ 
            'title'=>'required',
            'description'=>'required'
        ]); //validar que los campos Objetivo y Descripción no estén vacíos
        $task->update($request->all()); //actualizar los datos en la base de datos
        return redirect()->route('tasks.index')->with('success','Objetivo actualizado'); //redireccionar a la vista principal
    }

    public function destroy(Task $task): RedirectResponse   
    {
        //
        //dd($task); //probar que se esté recibiendo la información
        $task->delete(); //eliminar el registro de la base de datos
        return redirect()->route('tasks.index')->with('success','Objetivo eliminado'); //redireccionar a la vista principal
    }
}
