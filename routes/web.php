<?php

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    sleep(2);
    $todos = Todo::all();
    return view('welcome', [
        'todos' => $todos
    ]);
});


Route::post('/todo', function(Request $request){

    $todo_title = $request->input("title");

    Todo::create([
        'title' => $todo_title
    ]);

    return redirect()->back();
});

Route::delete('/todo/{id}', function(Request $request, $id){
    $todo = Todo::find($id);
    $todo->delete();

    return redirect()->back();
});
