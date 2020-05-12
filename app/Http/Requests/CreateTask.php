<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTask extends FormRequest
{
    protected $errorBag='create';//定义特有的错误包，防止和别的表单串用
    
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255',//数据库验证前一步验证
            'project_id'=>['required',
            'integer',
            Rule::exists('projects','id')->whereIn('id',$this->user()
            ->projects()->pluck('id')->toArray())
            ]
        ];
    }

    public function messages(){
        return [
            'name.required'=>'任务名称必填',
            'name.max'=>'名称长度字符限制为：255',
            'project_id.required'=>'没有提交当前任务所属的项目ID',
            'project_id.integer'=>'所提交的项目ID无效（非整数）',
            'project_id.exists'=>'所提交的项目ID无效（不存在该项目）'
        ];
    }
}
