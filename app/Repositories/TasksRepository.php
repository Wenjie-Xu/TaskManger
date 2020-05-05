<?php
namespace App\Repositories;

use App\Task;

class TasksRepository
{
	public function create($request){
		return Task::create([
	            'name'=>$request->name,
	            'completion'=>(int) false,//默认未完成
	            'project_id'=>$request->project_id
	        ]);
	}

	public function find($id){
		$task = Task::findOrFail($id);
		return $task;
	}

	public function check($id){
		$task = $this->find($id);
		$task->completion = (int) true;
        return $task->save();
	}
}
?>