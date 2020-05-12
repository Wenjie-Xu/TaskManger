<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateTask extends FormRequest
{      
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
            'project'=>['required',
                    'integer',
                    Rule::exists('projects','id')->where(function($query){
                        return $query->whereIn('id',$this->user()->projects()->pluck('id'));
                    })
                ]//whereIn方法会对第二参数集合进行转数组
        ];
    }

    public function messages(){
        return [
            'name.required'=>'任务名称必填',
            'name.max'=>'名称长度字符限制为：255',
            'project.required'=>'没有提交当前任务所属的项目ID',
            'project.integer'=>'所提交的项目ID无效（非整数）',
            'project.exists'=>'所提交的项目ID无效（当前用户无该项目）'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        //遇到错误时，会修改当前的errorBag，默认为default
        $this->errorBag = 'update-'.$this->route('task');
        parent::failedValidation($validator);//继续执行父类中的逻辑
    }
}
