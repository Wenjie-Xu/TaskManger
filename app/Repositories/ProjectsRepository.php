<?php
namespace App\Repositories;

use App\Project;
use Image;//使用image组件

class ProjectsRepository
{

	public function create($request){
		/**
    	 * $request->user();返回当前用户实例
    	 * 通过当前对象和project的关系，来创建属于当前用户的表单
    	 */
    	$thumbname = $this -> thumb($request);
    	$request->user()->projects()->create([
			'name'=>$request->input('name'),//也可以用input函数来保存
			'thumbnail'=>$thumbname//存储返回的文件位置
			//外键的值可以不用填，关系中已经维护
    	]);
    	/**
    	 * 如果不通过关系来创建
    	 Project::create([
			 'name'=>$request->name,
			 'thumbnail'=>$request->thumbnail,
			 'user_id'=>$request->user()->id;
    	 ]);
		*/	
		return $thumbname;
	}

	public function findProject($id){
		// 在数据库中通过id找到对应的model，比find方法有更好的错误提示
		return Project::findOrFail($id);//通过id找到Model的实例
	}

	public function list(){
		return request()->user()->projects()->get();
	}

	public function deleteProject($id){
		$project = $this->findProject($id);
		$project -> delete();//对象的删除
	}

	public function update($request,$id){
		$project = $this->findProject($id);
		$project->name = $request->name;
		//如果上传了图片，则覆盖
		if($request->hasFile('thumbnail')){
			$project->thumbnail=$this -> thumb($request);
		}
		$project->save();//保存对象的属性
	}

	public function thumb($request)
	{
		//判断请求中是否含有文件对象
		if($request->hasFile('thumbnail')){
			$file = $request->thumbnail;
			$thumbname = $file -> hashName();//给文件重新哈希命名，且包含文件后缀
			$path = storage_path('app/public/thumbs/cropped/');
			//获取storage文件夹下的绝对路径
			$file2 = Image::make($file);//读取文件
			$file2 -> resize(200,90)->save($path.$thumbname);
			//处理图片后，并保存(文件夹需要自己手动创建)
			$file->storeAs('public/thumbs/origincal',$thumbname);//存储图片
			return $thumbname;
		}else{
			return null;
		}
	}

	public function todos($project){
		$todos = $project->tasks()->where('completion',0)->get();
		return $todos;
	}

	public function dones($project){
		$dones = $project->tasks()->where('completion',1)->get();
		return $dones;
	}
}
?>