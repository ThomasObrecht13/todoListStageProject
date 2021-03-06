<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TodoList::orderBy('id','ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTodoList = new TodoList;
        $newTodoList->title = $request->todoList["title"];

        $newTodoList->save();

        return $newTodoList;
    }

    /**
     * Remove the specified resource from storage.
     * and delete all tasks associate with this todoList
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingTodoList = TodoList::find($id);
        if($existingTodoList) {
            $existingTodoList->delete();

            $tasks = Task::orderBy('created_at','DESC')->get()->where('todo_list_id', '=', $id);
            if (count($tasks) > 0) {
                foreach ($tasks as $task) {
                    $task->delete();
                }

            }
            return "List successfully delete";
        }
        return "No list found";
    }
}
