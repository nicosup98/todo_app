<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function getAll() {
        return response(Todo::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request) {
        $todo = new Todo;
        $todo->title = $request->tile;
        $todo->description = $request->description;
        $todo->state = $request->state;

        if($request->user_id != null) {
            $todo->user_id = $request->user_id;
        }

        $todo->save();

        return response("creado exitosamente",200);
    }

    /**
     * Display the specified resource.
     */
    public function get($todoId) {
        $todo = Todo::find($todoId);

        if(empty($todo)){
            return response("no se encontro la tarea con id $todoId",404);
        }
        return response($todo,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        $todo = Todo::find($request->id);

        $todo->title = $request->tile;
        $todo->description = $request->description;
        $todo->state = $request->state;

        $todo->save();

        return response("cambiado exitosamente",200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $todo = Todo::find($id);

        if(empty($todo)){
            return response("no se encuentra la tarea con id $id",404);
        }

        $todo->destroy();

        return response("eliminado satisfactoriamnente",200);
    }
}
