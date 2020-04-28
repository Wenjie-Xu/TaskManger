<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            // 'name'=>'required|unique:projects', 字符串的写法

            //使用数组的写法，更灵活的限制
            'name'=>[
                'required',
                Rule::unique('projects')->ignore($this->route('project'))->where(function($query){
                    return $query->where('user_id',request()->user()->id);
                })//对当前用户进行表字段限定
            ],
            'thumbnail'=>'image|dimensions:min_width=260,min_height=100|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'项目名称不能空',
            'name.unique'=>'项目名称重复',
            'thumbnail.image'=>'上传的文件不是图片',
            'thumbnail.dimensions'=>'图片大小不符合规范',
            'thumbnail.max'=>'图片最大为2M'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        //遇到错误时，会修改当前的errorBag，默认为default
        $this->errorBag = 'update-'.$this->route('project');
        parent::failedValidation($validator);//继续执行父类中的逻辑
    }
}
