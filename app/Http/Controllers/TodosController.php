<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    /**
     * Index para mostrar todos los Todos
     * Store para guardar un Todo
     * Update para actualizar un Todo
     * Destroy para eliminar un Todo
     * Edit para mostrar el formulario de edicion
     */

    public function store(Request $request){
        //Validar datos
        $request->validate([
            'title'=>'required|min:3' //Titulo: tenga un dato de min 3 caracteres
        ]);

        $todo = new Todo;
        $todo->title = $request->title; //Almacena el titulo dado
        $todo->category_id = $request->category_id;
        $todo->save(); //Se guarda en la BD

        //Se redirige al usuario con mensaje en la solicitud de respuesta
        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    public function index(){
        $todos = Todo::all(); //Se muestra todo de la BD
        $categories = Category::all(); //Se agregan las categorias
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function show($id){
        $todo = Todo::find($id); //Busca la id del parametro
        return view('todos.show', ['todo' => $todo]);
    }

    public function update(Request $request, $id){
        $todo = Todo::find($id); //Busca la id del parametro
        $todo->title = $request->title;
        $todo->save();

        //dd($todo); //Debuggin rapido

        return redirect()->route('todos')->with('success', 'Tarea actualizada!');
    }

    public function destroy($id){
        $todo = Todo::find($id); //Busca la id del parametro
        $todo->delete();

        return redirect()->route('todos')->with('success', 'Tarea eliminada');
    }
}
