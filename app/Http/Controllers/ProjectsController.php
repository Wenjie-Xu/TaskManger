<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectsRepository;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;

class ProjectsController extends Controller
{
	protected $proj;

	public function __construct(ProjectsRepository $proj){
		$this->proj = $proj;
		$this->middleware('auth');
	}

	//增（create）
	public function create(){
		//因为使用了Modal，所以不需要用单独的页面去做创建
	}
	
	/*因为继承了FormRequest，而FormRequest继承了Request
	 *所以CreateProjectRequest继承了Request*/
    public function store(CreateProjectRequest $request)
    {
    	$this->proj->create($request);
    	return redirect('/');//重定向指定的url
    	// return back();跳转回上一个url
    	
    	//view('welcome')直接访问该视图，只会单纯的访问，不会调用对应的Controller
    }

	//删（deleteProject）
    public function destory($id)
    {
    	$this->proj->deleteProject($id);
    	return redirect()->back();
	}
	
	//改（update）
    public function update(UpdateProjectRequest $request,$id){
    	$this->proj->update($request,$id);
    	return back();
	}

	//查（list/show）
	/**
     * 登录成功后，在主页列出所有的项目
	 * 查看单个项目明细
     */
	public function root()
    {
        $projects=$this->proj->list();//获取当前用户的所有project
        return view('welcome',compact('projects'));//将projects变量传递给view视图
    }

	public function show($id){
		$project = $this->proj->findProject($id);
		$todos = $this->proj->todos($project);
		$dones = $this->proj->dones($project);
		//该方法能够生成id=>name的数组
		$projects = auth()->user()->projects()->pluck('name','id');
		return view('projects.show',compact('project','todos','dones','projects'));//将项目传递给任务页面
	}



	

}
