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

	public function delete($id){
		$task = $this->find($id);
		return $task->delete();
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

	public function update($request, $task){
		$task=$this->find($task);
		return $task->update([
			'name'=>$request->name,
			'project_id'=>$request->project_id
		]);
	}

	public function todos(){
		return auth()->user()->tasks()->where('completion',0)->paginate(2);//获取分页后的全部数据
	}

	public function dones(){
		return auth()->user()->tasks()->where('completion',1)->paginate(2);
	}

}
?>