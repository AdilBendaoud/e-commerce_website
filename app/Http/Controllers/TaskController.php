<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $highestId = Task::max('id');
        if($highestId == null){
            $highestId = 0;
        }
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);
        $task = new Task();
        $task->id= (int)$highestId+1;
        $task->title = $validatedData['title'];
        $task->completed = false;
        $task->save();
        return response()->json(['message'=>'added successfully.']);
    }

    public function highestId(){
        $highestId = Task::max('id');
        return response()->json(['id'=>$highestId]);
    }

    public function toggleCompleted(Task $task){
        $task->completed = !$task->completed;
        $task->save();
        return response()->json(['message'=>'changed successfully']);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return;
    }
}
