<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable=['name','thumbnail'];//允许批量添加的属性

    public function user(){
    	//$project->user
    	return $this->belongsTo('App\User','user_id');
    	//默认会通过表明_id去寻找对应的字段，如果非一般命名，需要写明第二个foreign_key参数
	}
	public function tasks(){
		return $this->hasMany('App\Task');
	}
}
