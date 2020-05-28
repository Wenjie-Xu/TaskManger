<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Repositories\TasksRepository;

class TaskCountComposer {
    public function __construct(TasksRepository $repo){
        $this->repo = $repo;
    }

    public function compose(View $view){
        //防止逻辑层出错，没登录就不会请求方法，也就没有数据传递到页面中
        if(auth()->user()){
            $view->with([
                    'totalCount' => $this->repo->totalCount(),
                    'todoCount'=> $this->repo->todoCount(),
                    'doneCount'=> $this->repo->doneCount()
                ]);    
        }    
    }
}