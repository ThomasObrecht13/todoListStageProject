<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::orderBy('created_at','DESC')->get();
    }

    /**
     * Display a listing of the tasks by todoList_id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTasksByTodoListId($todo_list_id)
    {
        return Task::orderBy('created_at','DESC')->get()->where('todo_list_id', '=', $todo_list_id);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTask = new Task;
        $newTask->title = $request->task["title"];
        $newTask->todo_list_id = $request->task["todo_list_id"];

        $newTask->save();
        return $newTask;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function switchCompleted(Request $request, $id)
    {
        $existingTask = Task::find($id);
        if( $existingTask ){
            $existingTask->completed = !$existingTask->completed;
            $existingTask->save();
            return $existingTask;
        }
        return "No Task Found";
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingTask = Task::find($id);

        if( $existingTask ){
            $existingTask->title = $request->task["title"];
            $existingTask->save();
            return $existingTask;
        }
        return "No Task Found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingTask = Task::find($id);

        if( $existingTask ){
            $existingTask->delete();
            return "Task successfully delete";
        }
        return "No Task Found";
    }
}
