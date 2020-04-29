<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'name','completion','project_id'
    ];//允许批量赋值

    public function project(){
        return $this->belongsTo('App\Project');
    }
}
