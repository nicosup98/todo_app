<?php

namespace App\Http\Controllers\api;

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
  
    public function store(Request $request) {
        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'state' => $request->state,
            'user_id' => $request->user_id
        ]);
        

        
        if(empty($todo)) {
            return reponse()->text("error al crear estudiante",500);
        }
        
        return response()->json($todo,200);
    }

    /**
     * Display the specified resource.
     */
    public function get(Request $_req,$todoId) {
        $todo = Todo::find($todoId);

        if(empty($todo)){
            return response("no se encontro la tarea con id $todoId",404)->header("content-type","text/plain");
        }
        return response($todo,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        $todo = Todo::find($request->id);

        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->state = $request->state;

        $todo->save();

        return response()->json([
            "message"=> "modificado satisfactoriamente", 
            "data"=>$todo
            ]
            ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $_req,$id) {
        $todo = Todo::find($id);

        if(empty($todo)){
            return response("no se encuentra la tarea con id $id",404)->header("content-type","plain/text");
        }

        $todo->delete();

        return response("eliminado satisfactoriamnente",200)->header("content-type","plain/text");
    }

    public function patch(Request $request,$id){
        $keys = ["title", "description", "state"];
        $todo = Todo::find($id);

        if(empty($todo)){
            return response("no se encuentra la tarea con id $id",404)->header("content-type","plain/text");
        }

        foreach($keys as $k){
            if($request->has($k)){
                $todo->$k = $request->$k;
            }
        }

        return response()->json(
            [
                "message" => "editado satisfactoriamente",
                "data" => $todo
            ],
            200
        );
    }
        

}
