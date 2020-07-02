<?php

namespace App\Http\Controllers;

use App\Step;
use App\Task;
use Illuminate\Http\Request;

class StepsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        // return $task->steps;
        //用于返回多个数据，K-V的形式
        return response()->json([
            'steps'=> $task->steps
        ], 200);
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
    public function store(Task $task, Request $request)
    {
        //直接通过response返回可以减少页面的刷新
        return response()->json([
            //通过关系创建对象，请求就一个参数，赋值给name
            'step'=>$task->steps()->create($request->only('name'))->refresh()
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task,Step $step)
    {
        // 更新步骤的状态，路由参数一定要全
        $step->update($request->only('completion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task,Step $step)
    {
        $step->delete();
        return response()->json([
            'msg' => '删除成功'
        ],204);
    }

    public function complete(Request $request, Task $task){
        $task->steps()->where('completion',0)->update([
            'completion' => $request->completion
        ]);
    }

    public function clear(Task $task){
        // 删除所有已完成步骤
        $task->steps()->where('completion',1)->delete();
    }
}
