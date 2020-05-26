<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;

class TaskCountComposer {
    public function compose(View $view){
    $view->with([
            'total'=>30,
            'todoCount'=>5,
            'doneCount'=>10
        ]);        
    }
}