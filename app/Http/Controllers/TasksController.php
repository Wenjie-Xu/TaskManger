<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Repositories\TasksRepository;
use App\Http\Requests\CreateTask;
use App\Http\Requests\UpdateTask;

class TasksController extends Controller
{
    protected $repo;

    public function __construct(TasksRepository $repo){
        $this->repo=$repo;
        $this->middleware('auth');//没有登陆则没法访问这些方法
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$todos = $this->repo->todos();
		$dones = $this->repo->dones();
		//该方法能够生成id=>name的数组
		$projects = auth()->user()->projects()->pluck('name','id');
		return view('tasks.index',compact('todos','dones','projects'));//将项目传递给任务页面
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
    public function store(CreateTask $request)
    {
        $this->repo->create($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show')->with('task',$task);
    }

    public function check($id){
        $this->repo->check($id);
        return redirect()->back();
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
    public function update(UpdateTask $request, $task)
    {
        $this->repo->update($request, $task);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return back();
    }
}
